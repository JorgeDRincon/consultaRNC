<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rnc;
use League\Csv\Reader;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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
     * @var int|null
     */
    protected $recordLimit = null; // <-- CAMBIO AQUÍ: Establecido a 1000 para pruebas.

    // Define los formatos de fecha posibles para intentar parsear
    protected $dateFormatAttempts = [
        'd/m/Y',    // 01/01/2023
        'd/m/y',    // 01/01/23
        'Y-m-d',    // 2023-01-01
        'm/d/Y',    // 01/01/2023 (formato americano)
        'j/n/Y',    // 1/1/2023 (sin ceros iniciales)
        'j/n/y',    // 1/1/23
    ];

    // Codificación de origen de tu archivo CSV (por ejemplo, 'Windows-1252', 'ISO-8859-1')
    // Es crucial que esta sea la codificación correcta de tu archivo.
    protected $csvEncoding = 'Windows-1252'; 

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $csvFilePath = $this->argument('csvFilePath');

        if (!file_exists($csvFilePath)) {
            $this->error("CSV file not found at: {$csvFilePath}");
            return Command::FAILURE;
        }

        // Verifica si mbstring está habilitado
        if (!extension_loaded('mbstring')) {
            $this->error("The 'mbstring' PHP extension is not loaded. It is required for character encoding conversion without 'iconv'.");
            $this->error("Please enable 'extension=mbstring' in your php.ini and restart your PHP processes.");
            return Command::FAILURE;
        }

        $this->info("Starting processing of CSV file: {$csvFilePath}");

        try {
            $csv = Reader::createFromPath($csvFilePath, 'r');
            $csv->skipInputBOM(); 
            
            $csv->setHeaderOffset(0); 

            $rawHeaders = $csv->getHeader();
            $this->info("Raw CSV Headers detected (before encoding conversion): " . implode(', ', $rawHeaders));

            // Convertir los encabezados crudos a UTF-8 antes de mapearlos
            $convertedRawHeaders = array_map(function($header) {
                return mb_convert_encoding($header, 'UTF-8', $this->csvEncoding);
            }, $rawHeaders);
            $this->info("Converted CSV Headers (UTF-8) for mapping: " . implode(', ', $convertedRawHeaders));


            // Pasamos AMBOS sets de encabezados al mapeo
            $headerMapping = $this->buildHeaderMapping($rawHeaders, $convertedRawHeaders); 
            $this->info("Mapped Headers (Internal): " . json_encode($headerMapping));

            $records = $csv->getRecords();

            $processedRncs = [];
            $batch = [];
            $count = 0;
            $updatedCount = 0;
            $createdCount = 0;

            // Calcula el total de registros para la barra de progreso
            // Si $recordLimit no es null, usa ese valor, de lo contrario, cuenta los registros del CSV.
            // Asegúrate de que $csv->count() considere el HeaderOffset para el total de registros de datos.
            $csvTotalRecords = $csv->count();
            if ($csv->getHeaderOffset() === 0) { // Si hay encabezados, restamos 1 fila del conteo total
                 $csvTotalRecords = max(0, $csvTotalRecords - 1);
            }
            $totalRecordsToProcess = is_null($this->recordLimit) ? $csvTotalRecords : min($this->recordLimit, $csvTotalRecords);

            $progressBar = $this->output->createProgressBar($totalRecordsToProcess);
            $progressBar->start();

            foreach ($records as $recordRow) {
                if (!is_null($this->recordLimit) && $count >= $this->recordLimit) {
                    $this->info("Reached record limit of {$this->recordLimit}. Stopping further processing.");
                    break; 
                }

                $mappedRecord = [];
                foreach ($headerMapping as $rawKey => $normalizedKey) {
                    $rawValue = array_key_exists($rawKey, $recordRow) ? $recordRow[$rawKey] : '';
                    
                    // Convertir cada valor del registro de la codificación original a UTF-8
                    $mappedRecord[$normalizedKey] = trim(mb_convert_encoding($rawValue, 'UTF-8', $this->csvEncoding));
                }
                
                $rnc = $mappedRecord['RNC'] ?? ''; 
                $businessName = $mappedRecord['RAZON_SOCIAL'] ?? ''; 
                $economicActivity = $mappedRecord['ACTIVIDAD_ECONOMICA'] ?? '';
                $startDateRaw = $mappedRecord['FECHA_DE_INICIO_OPERACIONES'] ?? '';
                $status = $mappedRecord['ESTADO'] ?? '';
                $paymentRegime = $mappedRecord['REGIMEN_DE_PAGO'] ?? '';


                if (empty($rnc)) {
                    $this->warn("Skipping record due to missing or empty 'RNC' field. Raw Record: " . json_encode($recordRow));
                    $progressBar->advance(); 
                    continue; 
                }

                // --- Manejo de la fecha (FECHA_DE_INICIO_OPERACIONES) ---
                $startDate = null;
                $cleanedStartDateRaw = preg_replace('/[^\d\/\-]/', '', $startDateRaw); 
                $cleanedStartDateRaw = trim($cleanedStartDateRaw);
                
                if (!empty($cleanedStartDateRaw)) {
                    $parsedDate = false;
                    foreach ($this->dateFormatAttempts as $format) {
                        try {
                            $carbonDate = Carbon::createFromFormat($format, $cleanedStartDateRaw);
                            if ($carbonDate && $carbonDate->format($format) === $cleanedStartDateRaw) { 
                                $startDate = $carbonDate->format('Y-m-d'); 
                                $parsedDate = true;
                                break; 
                            }
                        } catch (\Exception $e) {
                            // No hacer nada, intentar el siguiente formato
                        }
                    }

                    if (!$parsedDate) {
                        $this->warn("Could not parse date for RNC {$rnc}: '{$startDateRaw}'. Setting 'start_date' to NULL.");
                        $startDate = null; 
                    }
                } else {
                    $startDate = null;
                }
                // --- Fin manejo de la fecha ---

                // --- Manejo de campos NOT NULL adicionales ---
                if (empty($businessName)) {
                    $this->warn("'RAZON_SOCIAL' is empty for RNC {$rnc}. Setting 'business_name' to default value 'N/A'.");
                    $businessName = 'N/A'; 
                }

                if (empty($economicActivity)) {
                    $this->warn("'ACTIVIDAD_ECONOMICA' is empty for RNC {$rnc}. Setting 'economic_activity' to default value 'N/A'.");
                    $economicActivity = 'N/A'; 
                }

                if (empty($paymentRegime)) {
                    $this->warn("'REGIMEN_DE_PAGO' is empty for RNC {$rnc}. Setting 'payment_regime' to default value 'N/A'.");
                    $paymentRegime = 'N/A'; 
                }
                
                if (empty($status)) {
                    $this->warn("'ESTADO' is empty for RNC {$rnc}. Setting 'status' to default value 'UNKNOWN'.");
                    $status = 'UNKNOWN'; 
                }
                
                $rncData = [
                    'rnc' => $rnc, 
                    'business_name' => $businessName,
                    'economic_activity' => $economicActivity,
                    'start_date' => $startDate, 
                    'status' => $status, 
                    'payment_regime' => $paymentRegime,
                    'updated_at' => Carbon::now(),
                ];

                $batch[] = $rncData;
                $processedRncs[] = $rnc;
                $count++;
                $progressBar->advance();

                if (count($batch) >= $this->chunkSize) {
                    $this->info("\nProcessing batch of " . count($batch) . " records...");
                    list($batchCreated, $batchUpdated) = $this->upsertBatch($batch);
                    $createdCount += $batchCreated;
                    $updatedCount += $batchUpdated;
                    $batch = [];
                }
            }

            $progressBar->finish();
            $this->info("\n"); 

            if (!empty($batch)) {
                $this->info("Processing final batch of " . count($batch) . " records...");
                list($batchCreated, $batchUpdated) = $this->upsertBatch($batch);
                $createdCount += $batchCreated;
                $updatedCount += $batchUpdated; // <-- CORREGIDO: antes decía += $updatedCount;
            }

            $this->info("Finished processing CSV. Total records processed from CSV: {$count}, Created: {$createdCount}, Updated: {$updatedCount}.");

            if (is_null($this->recordLimit) || $this->recordLimit === 0 || $count < $this->recordLimit) {
                $this->info("Checking for records to deactivate...");
                $this->deactivateMissingRecords($processedRncs);
            } else {
                $this->warn("Skipping deactivation of records because record limit is active. Only the first {$this->recordLimit} records from CSV were processed.");
            }

            $this->info("Data processing completed successfully.");

        } catch (\Exception $e) {
            $this->error("An error occurred during CSV processing: " . $e->getMessage());
            $this->error("Stack trace: " . $e->getTraceAsString());
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }

    /**
     * Construye un mapeo de encabezados, usando los encabezados originales del CSV
     * como claves y los nombres de columna normalizados como valores.
     *
     * @param array $rawHeaders Los encabezados tal como League\Csv los leyó (antes de cualquier conversión).
     * @param array $convertedRawHeaders Los encabezados ya convertidos a UTF-8.
     * @return array Un array asociativo donde la clave es el encabezado crudo original y el valor es el encabezado normalizado.
     */
    protected function buildHeaderMapping(array $rawHeaders, array $convertedRawHeaders): array
    {
        $mapping = [];
        $expectedHeaders = [
            'RNC' => 'RNC',
            'RAZÓN SOCIAL' => 'RAZON_SOCIAL', 
            'ACTIVIDAD ECONÓMICA' => 'ACTIVIDAD_ECONOMICA', 
            'FECHA DE INICIO OPERACIONES' => 'FECHA_DE_INICIO_OPERACIONES', 
            'ESTADO' => 'ESTADO',
            'RÉGIMEN DE PAGO' => 'REGIMEN_DE_PAGO',
        ];

        foreach ($convertedRawHeaders as $index => $convertedHeader) {
            $cleanConvertedHeader = trim(str_replace("\xEF\xBB\xBF", '', $convertedHeader)); 
            
            $normalizedCsvHeader = Str::ascii($cleanConvertedHeader); 
            $normalizedCsvHeader = preg_replace('/[^a-zA-Z0-9\s]/', '', $normalizedCsvHeader); 
            $normalizedCsvHeader = str_replace(' ', '_', $normalizedCsvHeader); 
            $normalizedCsvHeader = strtoupper($normalizedCsvHeader); 
            $normalizedCsvHeader = preg_replace('/_+/', '_', $normalizedCsvHeader); 
            $normalizedCsvHeader = trim($normalizedCsvHeader, '_'); 

            $matched = false;
            foreach ($expectedHeaders as $displayHeader => $dbColumnName) {
                $normalizedExpectedDisplayHeader = Str::ascii($displayHeader);
                $normalizedExpectedDisplayHeader = preg_replace('/[^a-zA-Z0-9\s]/', '', $normalizedExpectedDisplayHeader);
                $normalizedExpectedDisplayHeader = str_replace(' ', '_', $normalizedExpectedDisplayHeader);
                $normalizedExpectedDisplayHeader = strtoupper($normalizedExpectedDisplayHeader);
                $normalizedExpectedDisplayHeader = preg_replace('/_+/', '_', $normalizedExpectedDisplayHeader);
                $normalizedExpectedDisplayHeader = trim($normalizedExpectedDisplayHeader, '_');

                if ($normalizedCsvHeader === $normalizedExpectedDisplayHeader) {
                    $mapping[$rawHeaders[$index]] = $dbColumnName; 
                    $matched = true;
                    break;
                }
            }

            if (!$matched) {
                $mapping[$rawHeaders[$index]] = $normalizedCsvHeader; 
                $this->warn("Header '{$rawHeaders[$index]}' was not explicitly mapped. Using normalized fallback '{$normalizedCsvHeader}'.");
            }
        }
        return $mapping;
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
            $this->error("Error during batch upsert for RNC: " . ($data['rnc'] ?? 'N/A') . " - " . $e->getMessage());
            throw $e; 
        }

        return [$created, $updated];
    }

    protected function deactivateMissingRecords(array $processedRncs)
    {
        $chunkSizeForDeactivation = 10000;
        $totalDeactivated = 0;

        $this->info("Starting deactivation process for records not found in CSV.");

        $processedRncsMap = array_flip($processedRncs);
        
        Rnc::select('rnc', 'id', 'status')
            ->orderBy('id')
            ->chunkById($chunkSizeForDeactivation, function ($dbRncsChunk) use (&$processedRncsMap, &$totalDeactivated) {
                $rncsToDeactivateInChunk = [];
                foreach ($dbRncsChunk as $dbRnc) {
                    if (!isset($processedRncsMap[$dbRnc->rnc]) && $dbRnc->status !== 'INACTIVE') {
                        $rncsToDeactivateInChunk[] = $dbRnc->rnc;
                    }
                }

                if (!empty($rncsToDeactivateInChunk)) {
                    DB::beginTransaction();
                    try {
                        $deactivatedCountInChunk = Rnc::whereIn('rnc', $rncsToDeactivateInChunk)
                                                    ->update(['status' => 'INACTIVE', 'updated_at' => Carbon::now()]);
                        $totalDeactivated += $deactivatedCountInChunk;
                        $this->info("Deactivated " . $deactivatedCountInChunk . " records in current chunk.");
                        DB::commit();
                    } catch (\Exception $e) {
                        DB::rollBack();
                        $this->error("Error deactivating a chunk of records: " . $e->getMessage());
                    }
                } else {
                    $this->info("No records to deactivate in this chunk.");
                }
            });
        
        $this->info("Total deactivated records: " . $totalDeactivated);
    }
}