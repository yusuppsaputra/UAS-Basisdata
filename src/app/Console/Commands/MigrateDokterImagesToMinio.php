<?php

namespace App\Console\Commands;

use App\Models\Dokter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateDokterImagesToMinio extends Command
{
    protected $signature = 'dokter:migrate-images-to-minio {--dry-run}';
    protected $description = 'Copy dokter images from public disk to MinIO and update DB paths when necessary.';

    public function handle()
    {
        $dry = $this->option('dry-run');

        $dokters = Dokter::whereNotNull('upload_gambar')->get();
        $this->info('Found ' . $dokters->count() . ' dokter records with upload_gambar values.');

        foreach ($dokters as $d) {
            $path = $d->upload_gambar;
            if (! $path) {
                continue;
            }

            // skip full URLs
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                $this->line("[SKIP] Dokter {$d->id_dokter} - path is a URL: {$path}");
                continue;
            }

            // already on minio?
            if (Storage::disk('minio')->exists($path)) {
                $this->line("[OK] Dokter {$d->id_dokter} - already on MinIO: {$path}");
                continue;
            }

            // if exists on public, copy
            if (Storage::disk('public')->exists($path)) {
                $this->line("[COPY] Dokter {$d->id_dokter} - copying {$path} -> minio/{$path}");

                if (! $dry) {
                    $contents = Storage::disk('public')->get($path);
                    Storage::disk('minio')->put($path, $contents);
                    // ensure public file remains, but update DB if desired (we keep same relative path)
                    $this->line("[DONE] Copied to MinIO: {$path}");
                }

                continue;
            }

            $this->line("[MISSING] Dokter {$d->id_dokter} - file not found on public nor minio: {$path}");
        }

        $this->info('Migration run finished' . ($dry ? ' (dry-run)' : '')); 

        return 0;
    }
}
