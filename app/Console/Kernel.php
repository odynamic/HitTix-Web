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
        // Jadwal untuk unpublish otomatis
        $schedule->call(function () {
            \App\Models\Event::where('status', 'published')
                ->where('active_until', '<', now())
                ->update(['status' => 'expired']);
        })->daily(); // Atau ->hourly() untuk lebih sering
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
