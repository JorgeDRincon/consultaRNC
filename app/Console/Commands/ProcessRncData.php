<?php

namespace App\Console\Commands;

use App\Models\Rnc;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use League\Csv\Reader;

class ProcessRncData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-rnc-data {csvFilePath}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes a CSV file containing RNC data for bulk insert/update/delete.';

    /**
     * The chunk size for batch processing.
     *
     * @var int
     */
    protected $chunkSize = 1000;

    /**
     * Limit the number of records to process for testing purposes.
     * Set to 0 or null to process all records.
     *
     * @var int|null
     */
    protected $recordLimit = null;

    protected $dateFormatAttempts = [
        'd/m/Y',
        'd/m/y',
        'Y-m-d',
        'm/d/Y',
        'j/n/Y',
        'j/n/y',
    ];

    protected $csvEncoding = 'Windows-1252';

    protected $expectedHeaders = [
        'RNC' => 'RNC',
        'RAZÓN SOCIAL' => 'RAZON_SOCIAL',
        'ACTIVIDAD ECONÓMICA' => 'ACTIVIDAD_ECONOMICA',
        'FECHA DE INICIO OPERACIONES' => 'FECHA_DE_INICIO_OPERACIONES',
        'ESTADO' => 'ESTADO',
        'RÉGIMEN DE PAGO' => 'REGIMEN_DE_PAGO',
    ];

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $csvFilePath = $this->argument('csvFilePath');

        if (! $this->validateInput($csvFilePath)) {
            return Command::FAILURE;
        }

        $this->info("Starting processing of CSV file: {$csvFilePath}");

        try {
            $csv = $this->setupCsv($csvFilePath);
            $headerMapping = $this->buildHeaderMapping($csv);

            [$createdCount, $updatedCount, $processedRncs] = $this->processRecords($csv, $headerMapping);

            $this->info("Finished processing CSV. Created: {$createdCount}, Updated: {$updatedCount}.");

            if ($this->shouldDeactivateRecords($processedRncs)) {
                $this->deactivateMissingRecords($processedRncs);
            }

            $this->info('Data processing completed successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred during CSV processing: '.$e->getMessage());
            $this->error('Stack trace: '.$e->getTraceAsString());

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    protected function validateInput(string $csvFilePath): bool
    {
        if (! file_exists($csvFilePath)) {
            $this->error("CSV file not found at: {$csvFilePath}");

            return false;
        }

        if (! extension_loaded('mbstring')) {
            $this->error("The 'mbstring' PHP extension is not loaded. Please enable 'extension=mbstring' in your php.ini.");

            return false;
        }

        return true;
    }

    protected function setupCsv(string $csvFilePath): Reader
    {
        $csv = Reader::createFromPath($csvFilePath, 'r');
        $csv->skipInputBOM();

        $delimiter = $this->detectDelimiter($csvFilePath);
        $this->info("Detected CSV delimiter: '{$delimiter}'");

        $csv->setDelimiter($delimiter);
        $csv->setEnclosure('"');
        $csv->setHeaderOffset(0);

        return $csv;
    }

    protected function processRecords(Reader $csv, array $headerMapping): array
    {
        $processedRncs = [];
        $batch = [];
        $count = 0;
        $updatedCount = 0;
        $createdCount = 0;

        $totalRecords = $this->calculateTotalRecords($csv);
        $progressBar = $this->output->createProgressBar($totalRecords);
        $progressBar->start();

        foreach ($csv->getRecords() as $recordRow) {
            if ($this->shouldStopProcessing($count)) {
                break;
            }

            $rncData = $this->processRecord($recordRow, $headerMapping);

            if (empty($rncData)) {
                $progressBar->advance();

                continue;
            }

            $batch[] = $rncData;
            $processedRncs[] = $rncData['rnc'];
            $count++;
            $progressBar->advance();

            if (count($batch) >= $this->chunkSize) {
                [$batchCreated, $batchUpdated] = $this->upsertBatch($batch);
                $createdCount += $batchCreated;
                $updatedCount += $batchUpdated;
                $batch = [];
            }
        }

        $progressBar->finish();
        $this->info("\n");

        if (! empty($batch)) {
            [$batchCreated, $batchUpdated] = $this->upsertBatch($batch);
            $createdCount += $batchCreated;
            $updatedCount += $batchUpdated;
        }

        return [$createdCount, $updatedCount, $processedRncs];
    }

    protected function processRecord(array $recordRow, array $headerMapping): ?array
    {
        $mappedRecord = $this->mapRecord($recordRow, $headerMapping);
        $rnc = trim($mappedRecord['RNC'] ?? '');

        if (empty($rnc)) {
            $this->warn("Skipping record due to missing or empty 'RNC' field.");

            return null;
        }

        if (! $this->isValidRnc($rnc)) {
            return null;
        }

        return [
            'rnc' => $rnc,
            'business_name' => $this->getDefaultValue($mappedRecord['RAZON_SOCIAL'] ?? '', 'N/A', $rnc, 'RAZON_SOCIAL', 'business_name'),
            'economic_activity' => $this->getDefaultValue($mappedRecord['ACTIVIDAD_ECONOMICA'] ?? '', 'N/A', $rnc, 'ACTIVIDAD_ECONOMICA', 'economic_activity'),
            'start_date' => $this->parseDate($mappedRecord['FECHA_DE_INICIO_OPERACIONES'] ?? '', $rnc),
            'status' => $this->getDefaultValue($mappedRecord['ESTADO'] ?? '', 'UNKNOWN', $rnc, 'ESTADO', 'status'),
            'payment_regime' => $this->getDefaultValue($mappedRecord['REGIMEN_DE_PAGO'] ?? '', 'N/A', $rnc, 'REGIMEN_DE_PAGO', 'payment_regime'),
            'updated_at' => Carbon::now(),
        ];
    }

    protected function mapRecord(array $recordRow, array $headerMapping): array
    {
        $mappedRecord = [];

        foreach ($headerMapping as $rawKey => $normalizedKey) {
            $rawValue = $recordRow[$rawKey] ?? '';
            $convertedValue = mb_convert_encoding($rawValue, 'UTF-8', $this->csvEncoding);
            $convertedValue = trim($convertedValue);
            $convertedValue = preg_replace('/[\x00-\x08\x0B\x0C\x0E-\x1F\x7F]/', '', $convertedValue);

            $mappedRecord[$normalizedKey] = $convertedValue;
        }

        return $mappedRecord;
    }

    protected function isValidRnc(string $rnc): bool
    {
        if (strpos($rnc, ';') !== false || strpos($rnc, ',') !== false) {
            $this->warn("RNC '{$rnc}' contains delimiter characters. Skipping record.");

            return false;
        }

        return true;
    }

    protected function parseDate(string $dateRaw, string $rnc): ?string
    {
        $cleaned = trim(preg_replace('/[^\d\/\-]/', '', $dateRaw));

        if (empty($cleaned)) {
            return null;
        }

        foreach ($this->dateFormatAttempts as $format) {
            try {
                $carbonDate = Carbon::createFromFormat($format, $cleaned);
                if ($carbonDate && $carbonDate->format($format) === $cleaned) {
                    return $carbonDate->format('Y-m-d');
                }
            } catch (\Exception $e) {
                continue;
            }
        }

        $this->warn("Could not parse date for RNC {$rnc}: '{$dateRaw}'. Setting 'start_date' to NULL.");

        return null;
    }

    protected function getDefaultValue(string $value, string $default, string $rnc, string $fieldName, string $dbFieldName): string
    {
        if (empty(trim($value))) {
            $this->warn("'{$fieldName}' is empty for RNC {$rnc}. Setting '{$dbFieldName}' to default value '{$default}'.");

            return $default;
        }

        return $value;
    }

    protected function calculateTotalRecords(Reader $csv): int
    {
        $csvTotalRecords = $csv->count();
        if ($csv->getHeaderOffset() === 0) {
            $csvTotalRecords = max(0, $csvTotalRecords - 1);
        }

        return is_null($this->recordLimit) ? $csvTotalRecords : min($this->recordLimit, $csvTotalRecords);
    }

    protected function shouldStopProcessing(int $count): bool
    {
        if (! is_null($this->recordLimit) && $count >= $this->recordLimit) {
            $this->info("Reached record limit of {$this->recordLimit}. Stopping further processing.");

            return true;
        }

        return false;
    }

    protected function shouldDeactivateRecords(array $processedRncs): bool
    {
        if (is_null($this->recordLimit) || $this->recordLimit === 0 || count($processedRncs) < $this->recordLimit) {
            return true;
        }

        $this->warn('Skipping deactivation of records because record limit is active.');

        return false;
    }

    protected function buildHeaderMapping(Reader $csv): array
    {
        $rawHeaders = $csv->getHeader();
        $this->info('Raw CSV Headers detected: '.implode(', ', $rawHeaders));

        if (empty($rawHeaders) || count($rawHeaders) < 2) {
            $this->warn('Warning: Only '.count($rawHeaders).' headers detected. This might indicate a delimiter issue.');
        }

        $convertedHeaders = array_map(fn ($header) => mb_convert_encoding($header, 'UTF-8', $this->csvEncoding), $rawHeaders);
        $this->info('Converted CSV Headers (UTF-8): '.implode(', ', $convertedHeaders));

        $mapping = [];

        foreach ($convertedHeaders as $index => $convertedHeader) {
            $cleanHeader = trim(str_replace("\xEF\xBB\xBF", '', $convertedHeader));
            $normalizedHeader = $this->normalizeHeader($cleanHeader);

            $matched = false;
            foreach ($this->expectedHeaders as $displayHeader => $dbColumnName) {
                if ($this->normalizeHeader($displayHeader) === $normalizedHeader) {
                    $mapping[$rawHeaders[$index]] = $dbColumnName;
                    $matched = true;
                    break;
                }
            }

            if (! $matched) {
                $mapping[$rawHeaders[$index]] = $normalizedHeader;
                $this->warn("Header '{$rawHeaders[$index]}' was not explicitly mapped. Using normalized fallback '{$normalizedHeader}'.");
            }
        }

        $this->info('Mapped Headers: '.json_encode($mapping));

        return $mapping;
    }

    protected function normalizeHeader(string $header): string
    {
        $normalized = Str::ascii($header);
        $normalized = preg_replace('/[^a-zA-Z0-9\s]/', '', $normalized);
        $normalized = str_replace(' ', '_', $normalized);
        $normalized = strtoupper($normalized);
        $normalized = preg_replace('/_+/', '_', $normalized);

        return trim($normalized, '_');
    }

    protected function upsertBatch(array $batch): array
    {
        $updated = 0;
        $created = 0;

        if (empty($batch)) {
            return [0, 0];
        }

        DB::beginTransaction();
        try {
            foreach ($batch as $data) {
                $rncModel = Rnc::updateOrCreate(
                    ['rnc' => $data['rnc']],
                    $data
                );

                if ($rncModel->wasRecentlyCreated) {
                    $created++;
                } else {
                    $updated++;
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Error during batch upsert for RNC: '.($data['rnc'] ?? 'N/A').' - '.$e->getMessage());
            throw $e;
        }

        return [$created, $updated];
    }

    protected function detectDelimiter(string $csvFilePath): string
    {
        $delimiters = [';', ',', "\t", '|'];
        $delimiterCounts = array_fill_keys($delimiters, 0);
        $maxLines = 5;

        $handle = @fopen($csvFilePath, 'r');
        if ($handle === false) {
            $this->warn('Could not open CSV file for delimiter detection. Using default ";".');

            return ';';
        }

        $linesRead = 0;
        while ($linesRead < $maxLines && ($line = fgets($handle)) !== false) {
            foreach ($delimiters as $delimiter) {
                $delimiterCounts[$delimiter] += substr_count($line, $delimiter);
            }
            $linesRead++;
        }

        fclose($handle);

        $maxCount = max($delimiterCounts);
        $detectedDelimiter = array_search($maxCount, $delimiterCounts);

        if ($maxCount === 0 || $detectedDelimiter === false) {
            $this->warn('Could not detect CSV delimiter. Using default ";".');

            return ';';
        }

        return $detectedDelimiter;
    }

    protected function deactivateMissingRecords(array $processedRncs): void
    {
        $this->info('Starting deactivation process for records not found in CSV.');

        $processedRncsMap = array_flip($processedRncs);
        $totalDeactivated = 0;
        $chunkSize = 10000;

        Rnc::select('rnc', 'id', 'status')
            ->orderBy('id')
            ->chunkById($chunkSize, function ($dbRncsChunk) use ($processedRncsMap, &$totalDeactivated) {
                $rncsToDeactivate = array_filter(
                    $dbRncsChunk->pluck('rnc')->toArray(),
                    fn ($rnc) => ! isset($processedRncsMap[$rnc])
                );

                if (empty($rncsToDeactivate)) {
                    return;
                }

                try {
                    DB::beginTransaction();
                    $deactivatedCount = Rnc::whereIn('rnc', $rncsToDeactivate)
                        ->where('status', '!=', 'INACTIVE')
                        ->update(['status' => 'INACTIVE', 'updated_at' => Carbon::now()]);

                    $totalDeactivated += $deactivatedCount;
                    $this->info("Deactivated {$deactivatedCount} records in current chunk.");
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    $this->error('Error deactivating a chunk of records: '.$e->getMessage());
                }
            });

        $this->info("Total deactivated records: {$totalDeactivated}");
    }
}
