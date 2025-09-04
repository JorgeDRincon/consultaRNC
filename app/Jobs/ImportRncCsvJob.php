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
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    /**
     * The file path to import.
     */
    protected string $filePath;

    /**
     * @param string $filePath
     * Create a new job instance.
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $fullPath = storage_path('app/private/imports/'.basename($this->filePath));

        try {
            Log::info('Job: Iniciando importación de CSV', ['file' => $this->filePath]);
            $count = Rnc::importCsv($fullPath);

            Log::info("Job: Importación completada. Registros procesados: $count");
        } catch (\Exception $e) {
            Log::error('Job: Error al importar el archivo CSV', ['error' => $e->getMessage()]);
        } finally {
            if ($fullPath && file_exists($fullPath)) {
                unlink($fullPath);
            }
        }
    }
}
