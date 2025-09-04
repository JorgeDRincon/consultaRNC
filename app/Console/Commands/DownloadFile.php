<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DownloadFile extends Command
{
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
        // --- Configuración de Rutas y URL ---
        $fileUrl = 'https://dgii.gov.do/app/WebApps/Consultas/RNC/RNC_CONTRIBUYENTES.zip';

        // Define la ruta temporal dentro del disco 'local' (storage/app/)
        // Esto creará el ZIP en 'storage/app/temp/RNC_CONTRIBUYENTES.zip'
        $tempZipPath = 'temp/RNC_CONTRIBUYENTES.zip';

        // ¡CAMBIO AQUÍ!
        // Ruta de destino final para el archivo extraído (dentro de storage/app/downloads/)
        // Esta ubicación NO es accesible públicamente por defecto.
        $finalDestinationBaseDir = 'downloads/';
        // ------------------------------------

        $this->info("Attempting to download ZIP file from: {$fileUrl}");

        try {
            // 1. Descargar el archivo ZIP.
            // Aumentamos el timeout a 10 minutos y sin verificar SSL para posibles problemas.
            $response = Http::timeout(600)->withoutVerifying()->get($fileUrl);

            // Verificar si la descarga fue exitosa
            if (! $response->successful()) {
                $this->error('Failed to download ZIP file. HTTP Status Code: '.$response->status());
                $this->error('Response body on failure: '.$response->body());

                return Command::FAILURE;
            }

            $zipContent = $response->body();
            $downloadedSize = strlen($zipContent);
            $expectedSize = $response->header('Content-Length');
            // Verificar si el tamaño de descarga coincide con el Content-Length
            if ($expectedSize && $downloadedSize != $expectedSize) {
                $this->error("Downloaded file size mismatch. Expected: {$expectedSize} bytes, Downloaded: {$downloadedSize} bytes.");
                $this->error('This indicates an incomplete download.');

                return Command::FAILURE;
            }

            // Verificar la firma 'PK' de un archivo ZIP válido
            if (substr($zipContent, 0, 4) !== "PK\x03\x04") {
                $this->error("Downloaded file does not appear to be a valid ZIP file (missing 'PK' signature).");

                return Command::FAILURE;
            }

            // Guardar el contenido ZIP en un archivo temporal usando el disco 'local' (storage/app/)
            // Esto garantiza que se guarde en storage/app/temp/
            Storage::disk('local')->put($tempZipPath, $zipContent);
            $fullTempZipPath = Storage::disk('local')->path($tempZipPath); // Obtener la ruta absoluta real
            $this->info('ZIP file downloaded temporarily to: '.$fullTempZipPath);

            // 2. Abrir el archivo ZIP.
            $zip = new ZipArchive;
            $openResult = $zip->open($fullTempZipPath);
            if ($openResult !== true) {
                $this->error('Could not open the downloaded ZIP file: '.$openResult.' (See ZipArchive::ER_ constants for details).');
                $this->error('This often means the downloaded file is not a valid ZIP or is corrupted.');

                // Mantener el ZIP para inspección manual si falla
                return Command::FAILURE;
            }

            // 3. Verificar y extraer el primer (y único) archivo.
            if ($zip->numFiles !== 1) {
                $this->error('The ZIP file contains '.$zip->numFiles.' files. Expected exactly 1 file.');
                $zip->close();
                Storage::disk('local')->delete($tempZipPath);

                return Command::FAILURE;
            }

            $innerFileName = $zip->getNameIndex(0);
            if ($innerFileName === false) {
                $this->error('Could not get the name of the file inside the ZIP archive.');
                $zip->close();
                Storage::disk('local')->delete($tempZipPath);

                return Command::FAILURE;
            }

            $extractedFileContent = $zip->getFromName($innerFileName);
            if ($extractedFileContent === false) {
                $this->error("Could not read content of '{$innerFileName}' from the ZIP file.");
                $zip->close();
                Storage::disk('local')->delete($tempZipPath);

                return Command::FAILURE;
            }

            // 4. Guardar el archivo extraído en su destino final (storage/app/downloads/).
            // Laravel creará la carpeta 'downloads' si no existe dentro de storage/app/
            Storage::disk('local')->put($finalDestinationBaseDir.$innerFileName, $extractedFileContent);
            $fullExtractedFilePathAbsolute = Storage::disk('local')->path($finalDestinationBaseDir.$innerFileName);
            $this->info("Single file '{$innerFileName}' extracted and saved to: ".$fullExtractedFilePathAbsolute);

            // 5. Cerrar el archivo ZIP y eliminar el temporal.
            $zip->close();
            Storage::disk('local')->delete($tempZipPath);
            $this->info('Temporary ZIP file deleted: '.$fullTempZipPath);

            // 6. Llamar a la nueva función de procesamiento.
            // Pasa la ruta absoluta del archivo CSV extraído al comando de procesamiento.
            $this->call('app:process-rnc-data', [
                'csvFilePath' => $fullExtractedFilePathAbsolute,
            ]);

            $this->info('File processing completed successfully.');
        } catch (\Exception $e) {
            $this->error('An error occurred: '.$e->getMessage());
            if ($e instanceof \GuzzleHttp\Exception\RequestException && $e->hasResponse()) {
                $this->error('HTTP client error response: '.$e->getResponse()->getBody()->getContents());
            }
            if (Storage::disk('local')->exists($tempZipPath)) {
                $this->warn('Temporary ZIP file was not deleted due to error. You can inspect it at: '.Storage::disk('local')->path($tempZipPath));
            }

            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
