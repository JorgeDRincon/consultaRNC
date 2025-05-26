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
        'RAZÓN SOCIAL' => 'business_name',
        'ACTIVIDAD ECONÓMICA' => 'economic_activity',
        'FECHA DE INICIO OPERACIONES' => 'start_date',
        'ESTADO' => 'status',
        'RÉGIMEN DE PAGO' => 'payment_regime',
        // Agrega aquí otras columnas si es necesario
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
    $totalRows = 0;

    try {
      $reader = Reader::createFromPath($csvFilePath, 'r');
      $reader->setHeaderOffset(0); // The first row is the header
      $records = $reader->getIterator();
      foreach ($records as $record) {
        $totalRows++;
      }
      // Reset iterator
      $reader = Reader::createFromPath($csvFilePath, 'r');
      $reader->setHeaderOffset(0);
      $records = $reader->getIterator();
      DB::beginTransaction(); // Start a transaction for mass update
      foreach ($records as $record) {
        if ($limit > 0 && $processedCount >= $limit) {
          break;
        }
        $mappedData = [];
        foreach ($columnMapping as $csvHeader => $dbColumn) {
          $value = $record[$csvHeader] ?? null;
          if ($value !== null) {
            $value = trim($value);
          }
          if (in_array($dbColumn, ['start_date'])) {
            if (!empty($value)) {
              try {
                $date = Carbon::parse($value);
                $value = $date->format('Y-m-d');
              } catch (\Exception $e) {
                Log::warning("RNC Import Model: Could not parse date '{$value}' for DB column '{$dbColumn}'. Error: {$e->getMessage()}");
                $value = null;
              }
            } else {
              $value = null;
            }
          }
          $mappedData[$dbColumn] = $value;
        }
        $batch[] = $mappedData;
        if (count($batch) >= $chunkSize) {
          try {
            self::upsert($batch, $uniqueBy, $updateColumns);
            $processedCount += count($batch);
            $batch = [];
            // Log progreso y guardar en archivo temporal
            Log::info("Importación RNC: Procesados $processedCount de $totalRows registros");
            file_put_contents(storage_path('app/import_progress.json'), json_encode([
              'processed' => $processedCount,
              'total' => $totalRows
            ]));
          } catch (\Exception $e) {
            Log::error('RNC Import Model: Error during batch upsert.', ['error' => $e->getMessage(), 'batch_size' => count($batch)]);
            throw $e;
          }
        }
      }
      if (!empty($batch)) {
        try {
          self::upsert($batch, $uniqueBy, $updateColumns);
          $processedCount += count($batch);
          // Log progreso final y guardar en archivo temporal
          Log::info("Importación RNC: Procesados $processedCount de $totalRows registros (final)");
          file_put_contents(storage_path('app/import_progress.json'), json_encode([
            'processed' => $processedCount,
            'total' => $totalRows
          ]));
        } catch (\Exception $e) {
          Log::error('RNC Import Model: Error during final batch upsert.', ['error' => $e->getMessage(), 'batch_size' => count($batch)]);
          throw $e;
        }
      }
      DB::commit();
      Log::info("RNC Import Model: Mass update/insert completed. Total records processed: {$processedCount}");
    } catch (\Exception $e) {
      DB::rollBack();
      Log::error('RNC Import Model: Exception during CSV processing.', ['error' => $e->getMessage()]);
      throw $e;
    }
    // Eliminar archivo de progreso al finalizar
    if (file_exists(storage_path('app/import_progress.json'))) {
      unlink(storage_path('app/import_progress.json'));
    }
    return $processedCount;
  }
}