<?php

namespace Database\Seeders;

use App\Models\Dokter;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AssignDokterImagesSeeder extends Seeder
{
    public function run(): void
    {
        $dokters = Dokter::whereNull('upload_gambar')->get();
        if ($dokters->isEmpty()) {
            $this->command->info('No Dokter without upload_gambar found.');

            return;
        }

        foreach ($dokters as $dokter) {
            // Use picsum to get a unique placeholder image per dokter
            $url = "https://picsum.photos/seed/dokter{$dokter->id}/600/600";

            try {
                $contents = @file_get_contents($url);
                if (! $contents) {
                    $this->command->warn("Failed to fetch image for Dokter {$dokter->id}, skipping.");

                    continue;
                }

                $filename = 'dokter/test-' . Str::uuid() . '.jpg';
                Storage::disk('minio')->put($filename, $contents, 'public');

                $dokter->upload_gambar = $filename;
                $dokter->save();

                $this->command->info("Assigned image to Dokter {$dokter->id}: {$filename}");
            } catch (Exception $e) {
                $this->command->error("Error assigning image to Dokter {$dokter->id}: " . $e->getMessage());
            }
        }
    }
}
