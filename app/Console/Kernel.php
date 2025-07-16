<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Tu comando existente
        $schedule->command('app:download-file')
                 ->everySecond()
                 ->withoutOverlapping()
                 ->appendOutputTo(storage_path('logs/download_and_process.log')); 
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands'); // Asegura que tus comandos se carguen

        require base_path('routes/console.php');
    }
}