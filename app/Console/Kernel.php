<?php
namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\CleanOrphanedPostImages::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // For example: Run every day at midnight
        $schedule->command('postimage:clean')->daily();

        // Run daily cleanup of read notifications older than 7 days
        $schedule->command('notifications:cleanup')->daily();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
