<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rnc as RncModel;
use Illuminate\Support\Facades\Log;
use LimitIterator;
use SplFileObject;
use DateTime;

class rnc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rnc:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filePath = 'C:/Users/ADMIN/Downloads/RNC_CONTRIBUYENTES/RNC_Contribuyentes_Actualizado_17_May_2025.csv';

        if (!file_exists($filePath)) {
            $this->error("Error: El archivo CSV no se encontró en la ruta especificada: {$filePath}");
            return;
        }

        $file = new SplFileObject($filePath, 'r');

        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY);

        $limitedIterator = new LimitIterator($file, 1, 5);

        $this->info("Iniciando importación desde: {$filePath}");

        foreach ($limitedIterator as $row) {
            if (empty(array_filter($row))) {
                continue;
            }

            $row = array_map(function($value) {
                return mb_convert_encoding($value, 'UTF-8', 'Windows-1252');
            }, $row);

            try {
                RncModel::create([
                    'rnc' => trim($row[0]), // Columna 0 de tu CSV
                    'business_name' => trim($row[1]), // Columna 1 de tu CSV
                    'economic_activity' => isset($row[2]) ? trim($row[2]) : null, // Columna 2 de tu CSV (opcional)
                    'start_date' => (new DateTime())->format('Y-m-d'), // Columna 3 de tu CSV (opcional)
                    'status' => isset($row[4]) ? trim($row[4]) : null, // Corregido: asumimos que es columna 4
                    'payment_regime' => isset($row[5]) ? trim($row[5]) : null,
                ]);
            } catch (\Exception $e) {
                $this->warn("Advertencia: No se pudo importar la fila: " . implode(', ', $row) . " - Mensaje: " . $e->getMessage());
            }
        }

        return Command::SUCCESS;
    }
}
