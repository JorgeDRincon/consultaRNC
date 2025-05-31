<?php

namespace App\Jobs;

use App\Models\Rnc;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ImportRncCsvJob implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  protected $filePath;

  /**
   * Create a new job instance.
   */
  public function __construct($filePath)
  {
    $this->filePath = $filePath;
  }

  /**
   * Execute the job.
   */
  public function handle()
  {
    try {
      Log::info('Job: Iniciando importación de CSV', ['file' => $this->filePath]);
      $fullPath = storage_path('app/private/imports/' . basename($this->filePath));
      $count = Rnc::importCsv($fullPath);

      Log::info("Job: Importación completada. Registros procesados: $count");
    } catch (\Exception $e) {
      Log::error('Job: Error al importar el archivo CSV', ['error' => $e->getMessage()]);
    } finally {
      if (file_exists($fullPath)) {
        unlink($fullPath);
      }
    }
  }
}