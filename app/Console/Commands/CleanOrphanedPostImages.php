<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Post;
use File;

class CleanOrphanedPostImages extends Command
{
    protected $signature = 'cleanup:postimages';
    protected $description = 'Delete orphaned images from the postimage folder';

    public function handle()
    {
        $this->info("🔍 Scanning postimage folder...");

        $imageDir = public_path('postimage');
        $files = File::files($imageDir);

        $usedImages = Post::pluck('image')->filter()->toArray();
        $deletedCount = 0;

        foreach ($files as $file) {
            $filename = $file->getFilename();

            if (!in_array($filename, $usedImages)) {
                File::delete($file->getPathname());
                $this->warn("🗑 Deleted: $filename");
                $deletedCount++;
            }
        }

        $this->info("✅ Cleanup completed. $deletedCount orphaned image(s) removed.");
    }
}
