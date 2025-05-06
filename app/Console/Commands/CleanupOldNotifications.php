<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupOldNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */ 
    protected $signature = 'notifications:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes read notifications older than 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $deleted = DB::table('notifications')
            ->whereNotNull('read_at')
            ->where('created_at', '<', now()->subDays(7))
            ->delete();

        $this->info("✅ Deleted $deleted old read notifications.");
    }
}
