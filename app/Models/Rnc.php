<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class Rnc extends Model
{
    use HasFactory;

    protected $fillable = [
        'rnc',
        'business_name',
        'economic_activity',
        'start_date',
        'status',
        'payment_regime',
    ];

    public static function importCsv(string $csvFilePath, int $limit = 0): int
    {
        // Configuration for the RNC CSV import (directly within the method)
        $config = [
            'chunk_size' => 5000, // Number of records to process per batch
            'csv_file_name' => 'RNC_CONTRIBUYENTES.csv', // Expected CSV file name (if you need to verify)

            // Column mapping: 'csv_column_name' => 'db_column_name'
            // ADJUST THIS ACCORDING TO THE ACTUAL COLUMN NAMES IN YOUR CSV AND YOUR DB!
            'column_mapping' => [
                'RNC' => 'rnc',
                'NOMBRE_RAZON_SOCIAL' => 'business_name',
                'ACTIVIDAD_ECONOMICA' => 'economic_activity',
                'FECHA_REGISTRO' => 'start_date', // Assuming this is the column in the CSV
                'ESTATUS' => 'status',             // Assuming this is the column in the CSV
                'REGIMEN_PAGO' => 'payment_regime', // Assuming this is the column in the CSV
                // Add all other columns you need to map here
            ],

            // Columns that identify a unique record for 'upsert'
            'unique_by' => ['rnc'],

            // Columns that should be updated if the record already exists
            // Make sure to include all columns you want to update, except those in 'unique_by'
            'update_columns' => [
                'business_name',
                'economic_activity',
                'start_date',
                'status',
                'payment_regime',
                // ... all other updatable columns
            ],
        ];

        if (!file_exists($csvFilePath)) {
            Log::error("RNC Import Model: CSV file not found.", ['path' => $csvFilePath]);
            throw new \Exception("CSV file not found at: {$csvFilePath}");
        }

        $processedCount = 0;
        $batch = [];
        $chunkSize = $config['chunk_size'];
        $columnMapping = $config['column_mapping'];
        $uniqueBy = $config['unique_by'];
        $updateColumns = $config['update_columns'];

        try {
            $reader = Reader::createFromPath($csvFilePath, 'r');
            $reader->setHeaderOffset(0); // The first row is the header

            $records = $reader->getIterator();

            DB::beginTransaction(); // Start a transaction for mass update

            foreach ($records as $record) {
                // If a limit is set and we've reached it, break the loop
                if ($limit > 0 && $processedCount >= $limit) {
                    break;
                }

                $mappedData = [];
                foreach ($columnMapping as $csvHeader => $dbColumn) {
                    $value = $record[$csvHeader] ?? null; // Get value, if not exists, it's null

                    // Clean and transform data if necessary (e.g., trim)
                    if ($value !== null) {
                        $value = trim($value);
                    }

                    // Specific transformation for dates if the column is a date column
                    if (in_array($dbColumn, ['start_date'])) { // Add all your date columns here
                        if (!empty($value)) {
                            try {
                                // Attempt to parse the date. Carbon is quite flexible with common formats.
                                $date = Carbon::parse($value);
                                $value = $date->format('Y-m-d'); // Standard format for the database
                            } catch (\Exception $e) {
                                Log::warning("RNC Import Model: Could not parse date '{$value}' for DB column '{$dbColumn}'. Error: {$e->getMessage()}");
                                $value = null; // Assign null if the format is incorrect
                            }
                        } else {
                            $value = null; // If CSV value is empty, store as null
                        }
                    }
                    $mappedData[$dbColumn] = $value;
                }

                $batch[] = $mappedData;

                if (count($batch) >= $chunkSize) {
                    try {
                        self::upsert($batch, $uniqueBy, $updateColumns); // Use self::upsert for static method
                        $processedCount += count($batch);
                        $batch = []; // Clear the batch
                    } catch (\Exception $e) {
                        Log::error('RNC Import Model: Error during batch upsert.', ['error' => $e->getMessage(), 'batch_size' => count($batch)]);
                        throw $e;
                    }
                }
            }

            // Process any remaining records in the last batch
            if (!empty($batch)) {
                try {
                    self::upsert($batch, $uniqueBy, $updateColumns); // Use self::upsert for static method
                    $processedCount += count($batch);
                } catch (\Exception $e) {
                    Log::error('RNC Import Model: Error during final batch upsert.', ['error' => $e->getMessage(), 'batch_size' => count($batch)]);
                    throw $e;
                }
            }

            DB::commit(); // Commit the transaction if everything went well
            Log::info("RNC Import Model: Mass update/insert completed. Total records processed: {$processedCount}");

        } catch (\Exception $e) {
            DB::rollBack(); // Rollback the transaction in case of error
            Log::error('RNC Import Model: Exception during CSV processing.', ['error' => $e->getMessage()]);
            throw $e; // Re-throw the exception
        }

        return $processedCount;
    }
}
