<?php

namespace App\Console\Commands;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use RuntimeException;
use ZipArchive;

class DownloadFile extends Command
{
    private const FILE_URL = 'https://dgii.gov.do/app/WebApps/Consultas/RNC/RNC_CONTRIBUYENTES.zip';

    private const TEMP_ZIP_PATH = 'temp/RNC_CONTRIBUYENTES.zip';

    private const FINAL_DESTINATION_DIR = 'downloads/';

    private const MAX_DOWNLOAD_ATTEMPTS = 5;

    private const MIN_ZIP_SIZE_BYTES = 1_000_000;

    private const ZIP_SIGNATURE = "PK\x03\x04";

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:download-file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Downloads a ZIP file, extracts a specific file, saves it, and then processes it.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Attempting to download ZIP file from: '.self::FILE_URL);

        try {
            $expectedSize = $this->fetchExpectedZipSize(self::FILE_URL);
            $fullTempZipPath = $this->prepareTempZip(self::TEMP_ZIP_PATH);

            $this->downloadZipWithResume(self::FILE_URL, $fullTempZipPath, $expectedSize, self::MAX_DOWNLOAD_ATTEMPTS);
            $this->assertZipIntegrity($fullTempZipPath, $expectedSize);

            [$innerFileName, $extractedFileContent] = $this->extractSingleFileFromZip($fullTempZipPath);
            $fullExtractedFilePathAbsolute = $this->storeExtractedFile($innerFileName, $extractedFileContent, self::FINAL_DESTINATION_DIR);

            $this->cleanupTempFile(self::TEMP_ZIP_PATH, $fullTempZipPath);
            $this->processExtractedFile($fullExtractedFilePathAbsolute);

            $this->info('File processing completed successfully.');

            return Command::SUCCESS;
        } catch (RuntimeException $exception) {
            $this->handleRuntimeException($exception);
        } catch (\Throwable $exception) {
            $this->error('An unexpected error occurred: '.$exception->getMessage());
        }

        if (Storage::disk('local')->exists(self::TEMP_ZIP_PATH)) {
            $this->warn('Temporary ZIP file was not deleted due to error. You can inspect it at: '.Storage::disk('local')->path(self::TEMP_ZIP_PATH));
        }

        return Command::FAILURE;
    }

    private function handleRuntimeException(RuntimeException $exception): void
    {
        $this->error($exception->getMessage());

        if ($exception instanceof RequestException && $exception->hasResponse()) {
            $this->error('HTTP client error response: '.$exception->getResponse()->getBody()->getContents());
        }
    }

    private function fetchExpectedZipSize(string $fileUrl): int
    {
        $headResponse = Http::withOptions([
            'http_errors' => false,
            'verify' => false,
        ])->head($fileUrl);

        if (! $headResponse->successful()) {
            throw new RuntimeException('HEAD request failed. HTTP Status Code: '.$headResponse->status());
        }

        $expectedSize = (int) $headResponse->header('Content-Length');

        if ($expectedSize <= 0) {
            throw new RuntimeException('Could not read a valid Content-Length from DGII.');
        }

        $this->info("Expected ZIP size: {$expectedSize} bytes");

        return $expectedSize;
    }

    private function prepareTempZip(string $tempZipPath): string
    {
        Storage::disk('local')->makeDirectory(dirname($tempZipPath));

        $fullTempZipPath = Storage::disk('local')->path($tempZipPath);

        if (! file_exists($fullTempZipPath)) {
            touch($fullTempZipPath);
        }

        return $fullTempZipPath;
    }

    private function downloadZipWithResume(string $fileUrl, string $fullTempZipPath, int $expectedSize, int $maxAttempts): void
    {
        $previousSize = file_exists($fullTempZipPath) ? filesize($fullTempZipPath) : 0;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            $this->info("Download attempt {$attempt} of {$maxAttempts}...");

            $command = $this->buildCurlCommand($fileUrl, $fullTempZipPath);
            $this->info('Running: '.$command);

            $lines = [];
            $exitCode = 0;
            exec($command, $lines, $exitCode);

            if ($exitCode !== 0) {
                $this->logCurlFailure($lines, $exitCode);
                throw new RuntimeException("curl exited with code {$exitCode}.");
            }

            if (! file_exists($fullTempZipPath)) {
                $this->logCurlFailure($lines);
                throw new RuntimeException('ZIP file was not created.');
            }

            clearstatcache(true, $fullTempZipPath);
            $currentSize = filesize($fullTempZipPath);
            $this->info("Current ZIP size: {$currentSize} bytes");

            if ($currentSize >= $expectedSize) {
                $this->info('Download appears complete.');

                return;
            }

            if ($currentSize <= $previousSize) {
                $this->logCurlFailure($lines);
                throw new RuntimeException('No progress between attempts. Stopping.');
            }

            $previousSize = $currentSize;
        }

        throw new RuntimeException('Max attempts reached and file is still incomplete.');
    }

    private function buildCurlCommand(string $fileUrl, string $fullTempZipPath): string
    {
        return sprintf(
            'curl -C - -L --http1.1 --max-time 600 --connect-timeout 30 --retry 3 --retry-delay 5 --retry-all-errors --fail --show-error -A %s -H %s -H %s -o %s %s 2>&1',
            escapeshellarg('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36'),
            escapeshellarg('Accept: */*'),
            escapeshellarg('Referer: https://dgii.gov.do/'),
            escapeshellarg($fullTempZipPath),
            escapeshellarg($fileUrl)
        );
    }

    private function logCurlFailure(array $lines, ?int $exitCode = null): void
    {
        if ($exitCode !== null) {
            $this->error("curl exited with code {$exitCode}.");
        }

        if (! empty($lines)) {
            $this->error("curl output:\n".implode("\n", $lines));
        }
    }

    private function assertZipIntegrity(string $fullTempZipPath, int $expectedSize): void
    {
        if (! file_exists($fullTempZipPath)) {
            throw new RuntimeException('ZIP file was not found after download.');
        }

        clearstatcache(true, $fullTempZipPath);
        $actualSize = filesize($fullTempZipPath);

        if ($actualSize < self::MIN_ZIP_SIZE_BYTES) {
            throw new RuntimeException('Downloaded file seems too small. Possible HTML error instead of ZIP.');
        }

        if ($actualSize < $expectedSize) {
            $this->warn('Downloaded ZIP size is smaller than expected Content-Length.');
        }

        $this->assertZipSignature($fullTempZipPath);
        $this->info('ZIP file downloaded temporarily to: '.$fullTempZipPath);
    }

    private function assertZipSignature(string $fullTempZipPath): void
    {
        $filePointer = fopen($fullTempZipPath, 'rb');

        if ($filePointer === false) {
            throw new RuntimeException('Could not open downloaded file for validation.');
        }

        $firstBytes = fread($filePointer, 4);
        fclose($filePointer);

        if ($firstBytes !== self::ZIP_SIGNATURE) {
            throw new RuntimeException("Downloaded file does not appear to be a valid ZIP file (missing 'PK' signature).");
        }
    }

    /**
     * Extracts the only file contained in the downloaded ZIP archive.
     *
     * @param string $fullTempZipPath The absolute path to the temporary ZIP file to extract
     *
     * @return array<int, string> Returns an array with [0] = inner file name, [1] = extracted file content
     */
    private function extractSingleFileFromZip(string $fullTempZipPath): array
    {
        $zip = new ZipArchive;
        $openResult = $zip->open($fullTempZipPath);

        if ($openResult !== true) {
            throw new RuntimeException(
                'Could not open the downloaded ZIP file: '.$openResult.' (See ZipArchive::ER_ constants for details).'
            );
        }

        try {
            if ($zip->numFiles !== 1) {
                throw new RuntimeException('The ZIP file contains '.$zip->numFiles.' files. Expected exactly 1 file.');
            }

            $innerFileName = $zip->getNameIndex(0);

            if ($innerFileName === false) {
                throw new RuntimeException('Could not get the name of the file inside the ZIP archive.');
            }

            $extractedFileContent = $zip->getFromName($innerFileName);

            if ($extractedFileContent === false) {
                throw new RuntimeException("Could not read content of '{$innerFileName}' from the ZIP file.");
            }

            return [$innerFileName, $extractedFileContent];
        } finally {
            $zip->close();
        }
    }

    private function storeExtractedFile(string $innerFileName, string $extractedFileContent, string $finalDestinationBaseDir): string
    {
        Storage::disk('local')->makeDirectory(rtrim($finalDestinationBaseDir, '/'));

        Storage::disk('local')->put($finalDestinationBaseDir.$innerFileName, $extractedFileContent);
        $fullExtractedFilePathAbsolute = Storage::disk('local')->path($finalDestinationBaseDir.$innerFileName);
        $this->info("Single file '{$innerFileName}' extracted and saved to: ".$fullExtractedFilePathAbsolute);

        return $fullExtractedFilePathAbsolute;
    }

    private function cleanupTempFile(string $tempZipPath, string $fullTempZipPath): void
    {
        Storage::disk('local')->delete($tempZipPath);
        $this->info('Temporary ZIP file deleted: '.$fullTempZipPath);
    }

    private function processExtractedFile(string $fullExtractedFilePathAbsolute): void
    {
        $this->call('app:process-rnc-data', [
            'csvFilePath' => $fullExtractedFilePathAbsolute,
        ]);
    }
}
