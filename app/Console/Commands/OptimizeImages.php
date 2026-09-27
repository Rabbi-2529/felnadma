<?php

namespace App\Console\Commands;

use App\Support\Img;
use Illuminate\Console\Command;

class OptimizeImages extends Command
{
    protected $signature = 'images:webp {--force : Rebuild WebP files even if they are up to date}';

    protected $description = 'Create resized WebP copies of every image in asset/images (used automatically by the public site)';

    public function handle()
    {
        $root = base_path('asset/images');
        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root, \FilesystemIterator::SKIP_DOTS));

        $before = 0;
        $after = 0;
        $count = 0;

        foreach ($files as $file) {
            if (!preg_match('/\.(jpe?g|png)$/i', $file->getFilename())) {
                continue;
            }

            $relative = 'asset/images/' . str_replace('\\', '/', substr($file->getPathname(), strlen($root) + 1));
            $webp = Img::webpPath($relative, (bool) $this->option('force'));

            if ($webp === null) {
                $this->warn("skipped  {$relative}");
                continue;
            }

            $count++;
            $before += $file->getSize();
            $after += filesize(base_path($webp));
            $this->line(sprintf('%-60s %6d KB -> %5d KB', $relative, $file->getSize() / 1024, filesize(base_path($webp)) / 1024));
        }

        $this->info(sprintf('%d images: %.1f MB -> %.1f MB', $count, $before / 1048576, $after / 1048576));

        return 0;
    }
}
