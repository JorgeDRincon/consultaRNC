<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\Csv\Reader;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class Rnc extends Model
{
  use HasFactory;

  protected $table = 'rncs';

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

    // Define date columns
    $dateColumns = ['created_at', 'updated_at', 'start_date']; // Adjust according to your columns

    try {
      // First read to get headers
      $reader = Reader::createFromPath($csvFilePath, 'r');
      $reader->setHeaderOffset(0);
      $reader->setDelimiter(',');
      $reader->skipInputBOM();

      // Read headers directly from file
      $file = fopen($csvFilePath, 'r');
      $headers = fgetcsv($file, 0, ',');
      fclose($file);

      // Convert headers to UTF-8
      $headers = array_map(function ($header) {
        return mb_convert_encoding(trim($header), 'UTF-8', 'Windows-1252');
      }, $headers);

      // Second read to process records
      $reader = Reader::createFromPath($csvFilePath, 'r');
      $reader->setHeaderOffset(0);
      $reader->setDelimiter(',');
      $reader->skipInputBOM();

      $totalRows = $reader->count();
      $records = $reader->getIterator();

      // Modify mapping to use UTF-8 headers
      $columnMapping = [];
      foreach ($config['column_mapping'] as $csvHeader => $dbColumn) {
        // Find UTF-8 header that matches the original header
        $utf8Header = array_filter($headers, function ($header) use ($csvHeader) {
          return mb_strtolower($header) === mb_strtolower($csvHeader);
        });

        if (!empty($utf8Header)) {
          $columnMapping[reset($utf8Header)] = $dbColumn;
        }
      }

      DB::beginTransaction(); // Start a transaction for mass update

      foreach ($records as $record) {
        if ($limit > 0 && $processedCount >= $limit) {
          break;
        }

        $mappedData = [];

        $utf8Record = [];
        foreach ($record as $key => $value) {
          $utf8Key = mb_convert_encoding($key, 'UTF-8', 'Windows-1252');
          $utf8Record[$utf8Key] = $value;
        }

        foreach ($columnMapping as $csvHeader => $dbColumn) {
          // Find original key in record
          $originalKey = array_search($csvHeader, array_map(function ($key) {
            return mb_convert_encoding($key, 'UTF-8', 'Windows-1252');
          }, array_keys($record)));

          $value = $originalKey !== false ? $record[array_keys($record)[$originalKey]] : null;

          if ($value !== null) {
            $value = trim($value);
          }

          // Columns that do NOT need encoding
          $noEncodingColumns = array_merge(['rnc'], $dateColumns);

          // Apply encoding to all columns except those that don't need it
          if (!in_array($dbColumn, $noEncodingColumns)) {
            $value = mb_convert_encoding($value, 'UTF-8', 'Windows-1252');
          }

          // Parse date if applicable
          if (in_array($dbColumn, $dateColumns)) {
            $value = self::parseDate($value);
          }

          $mappedData[$dbColumn] = $value;
        }

        // Log skipped records with reasons
        if (empty($mappedData['business_name']) || empty($mappedData['rnc'])) {
          $reason = [];
          if (empty($mappedData['business_name'])) $reason[] = 'business_name is empty';
          if (empty($mappedData['rnc'])) $reason[] = 'rnc is empty';

          Log::warning('RNC Import Model: Record skipped', [
            'record' => $record,
            'mapped_data' => $mappedData,
            'reason' => implode(', ', $reason)
          ]);
          continue;
        }

        $batch[] = $mappedData;
        if (count($batch) >= $chunkSize) {
          try {
            self::upsert($batch, $uniqueBy, $updateColumns);
            $processedCount += count($batch);
            $batch = [];
            // Log progress and save to temporary file
            self::saveProgress($processedCount, $totalRows);
          } catch (\Exception $e) {
            throw $e;
          }
        }
      }
      if (!empty($batch)) {
        try {
          self::upsert($batch, $uniqueBy, $updateColumns);
          $processedCount += count($batch);
          // Log final progress and save to temporary file
          self::saveProgress($processedCount, $totalRows);
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
    // Delete progress file when finished
    if (file_exists(storage_path('app/import_progress.json'))) {
      unlink(storage_path('app/import_progress.json'));
    }
    return $processedCount;
  }

  private static function parseDate($value)
  {
    if (empty($value)) {
      return null;
    }
    try {
      $date = \Carbon\Carbon::createFromFormat('d/m/Y', $value);
      // If date is invalid, createFromFormat returns false
      if (!$date || $date->format('Y-m-d') === '-0001-11-30') {
        Log::error('RNC Import Model: Invalid date detected during parsing.', [
          'original_value' => $value,
          'parse_result' => $date ? $date->format('Y-m-d') : null
        ]);
        return null;
      }
      return $date->format('Y-m-d');
    } catch (\Exception $e) {
      Log::error('RNC Import Model: Error during date parsing.', [
        'error' => $e->getMessage(),
        'original_value' => $value
      ]);
      return null;
    }
  }

  private static function saveProgress($processedCount, $totalRows)
  {
    $progress = [
      'processed' => $processedCount,
      'total' => $totalRows,
      'skipped' => $totalRows - $processedCount
    ];

    file_put_contents(storage_path('app/import_progress.json'), json_encode($progress));

    // Log progress every 1000 records
    if ($processedCount % 1000 === 0) {
      Log::info('RNC Import Model: Progress update', $progress);
    }
  }

  public static function filterByParams(array $params)
  {
    $query = self::query();

    if (isset($params['rnc']) && $params['rnc'] !== '') {
      $query->where('rnc', $params['rnc']);
    }
    if (!empty($params['business_name'])) {
      $query->where('business_name', 'LIKE', "%{$params['business_name']}%");
    }
    if (!empty($params['economic_activity'])) {
      $query->where('economic_activity', 'LIKE', "%{$params['economic_activity']}%");
    }
    if (!empty($params['status'])) {
      $query->where('status', $params['status']);
    }
    if (!empty($params['payment_regime'])) {
      $query->where('payment_regime', $params['payment_regime']);
    }
    if (!empty($params['start_date_from']) && !empty($params['start_date_to'])) {
      $query->whereBetween('start_date', [$params['start_date_from'], $params['start_date_to']]);
    } elseif (!empty($params['start_date_from'])) {
      $query->where('start_date', '>=', $params['start_date_from']);
    } elseif (!empty($params['start_date_to'])) {
      $query->where('start_date', '<=', $params['start_date_to']);
    }

    // Determina si hay algún filtro aplicado
    $hasFilter = !empty(array_filter([
      isset($params['rnc']) && $params['rnc'] !== '' ? $params['rnc'] : null,
      $params['business_name'] ?? null,
      $params['economic_activity'] ?? null,
      $params['status'] ?? null,
      $params['payment_regime'] ?? null,
      $params['start_date_from'] ?? null,
      $params['start_date_to'] ?? null,
    ], function ($v) {
      return $v !== null && $v !== '';
    }));

    return [
      'query' => $query,
      'hasFilter' => $hasFilter
    ];
  }

  public static function getAllowedSearchParams()
  {
    $columns = Schema::getColumnListing((new self)->getTable());
    $special = ['start_date_from', 'start_date_to'];
    // Exclude 'id'
    return array_diff(array_merge($columns, $special), ['id']);
  }
}