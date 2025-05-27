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

    // Definir columnas de fecha
    $dateColumns = ['fecha_registro', 'created_at', 'updated_at', 'start_date']; // Ajusta según tus columnas

    try {
      // Primera lectura para obtener los headers
      $reader = Reader::createFromPath($csvFilePath, 'r');
      $reader->setHeaderOffset(0);
      $reader->setDelimiter(',');
      $reader->skipInputBOM();

      // Leer los headers directamente del archivo
      $file = fopen($csvFilePath, 'r');
      $headers = fgetcsv($file, 0, ',');
      fclose($file);

      // Convertir los headers a UTF-8
      $headers = array_map(function ($header) {
        return mb_convert_encoding(trim($header), 'UTF-8', 'Windows-1252');
      }, $headers);

      // Segunda lectura para procesar los registros
      $reader = Reader::createFromPath($csvFilePath, 'r');
      $reader->setHeaderOffset(0);
      $reader->setDelimiter(',');
      $reader->skipInputBOM();

      $totalRows = $reader->count();
      $records = $reader->getIterator();

      // Modificar el mapping para usar los headers en UTF-8
      $columnMapping = [];
      foreach ($config['column_mapping'] as $csvHeader => $dbColumn) {
        // Buscar el header en UTF-8 que coincida con el header original
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
          // Buscar la key original en el record
          $originalKey = array_search($csvHeader, array_map(function ($key) {
            return mb_convert_encoding($key, 'UTF-8', 'Windows-1252');
          }, array_keys($record)));

          $value = $originalKey !== false ? $record[array_keys($record)[$originalKey]] : null;

          if ($value !== null) {
            $value = trim($value);
          }

          // Columnas que NO necesitan encoding
          $noEncodingColumns = array_merge(['rnc'], $dateColumns);

          // Aplica encoding a todas las columnas excepto las que no lo necesitan
          if (!in_array($dbColumn, $noEncodingColumns)) {
            $value = mb_convert_encoding($value, 'UTF-8', 'Windows-1252');
          }

          // Parsear fecha si corresponde
          if (in_array($dbColumn, $dateColumns)) {
            $value = self::parseDate($value);
          }

          $mappedData[$dbColumn] = $value;
        }
        // Saltar filas sin business_name o rnc
        if (empty($mappedData['business_name']) || empty($mappedData['rnc'])) {
          continue;
        }
        $batch[] = $mappedData;
        if (count($batch) >= $chunkSize) {
          try {
            self::upsert($batch, $uniqueBy, $updateColumns);
            $processedCount += count($batch);
            $batch = [];
            // Log progreso y guardar en archivo temporal
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
          // Log progreso final y guardar en archivo temporal
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
    // Eliminar archivo de progreso al finalizar
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
      // Si la fecha no es válida, createFromFormat retorna false
      if (!$date || $date->format('Y-m-d') === '-0001-11-30') {
        Log::error('RNC Import Model: Fecha inválida detectada durante el parseo.', [
          'valor_original' => $value,
          'resultado_parseo' => $date ? $date->format('Y-m-d') : null
        ]);
        return null;
      }
      return $date->format('Y-m-d');
    } catch (\Exception $e) {
      Log::error('RNC Import Model: Error durante el parseo de fecha.', [
        'error' => $e->getMessage(),
        'valor_original' => $value
      ]);
      return null;
    }
  }

  private static function saveProgress($processedCount, $totalRows)
  {
    file_put_contents(storage_path('app/import_progress.json'), json_encode([
      'processed' => $processedCount,
      'total' => $totalRows
    ]));
  }
}
