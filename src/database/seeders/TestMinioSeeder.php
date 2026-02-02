<?php

namespace Database\Seeders;

use App\Models\poliklinik;
use App\Models\RumahSakit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestMinioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // force using minio disk for test seed
        $diskName = 'minio';
        $disk = Storage::disk($diskName);

        // Try to download sample image
        $contents = @file_get_contents('https://picsum.photos/1200/800');
        if ($contents === false) {
            // fallback to 1x1 transparent png
            $contents = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=');
        }

        // Rumah Sakit image
        $rsPath = 'rumahsakit/test-' . uniqid() . '.jpg';
        $disk->put($rsPath, $contents);

        $rs = RumahSakit::create([
            'upload_gambar' => $rsPath,
            'nama' => 'RS Test ' . uniqid(),
            'alamat' => 'Jl. Contoh No. 1',
            'kota' => 'Kota Test',
            'provinsi' => 'Provinsi Test',
            'no_telepon' => '081234567890',
            'kelas_rumah_sakit' => 'C',
        ]);

        // Poliklinik image
        $poliPath = 'poliklinik/test-' . uniqid() . '.jpg';
        $disk->put($poliPath, $contents);

        poliklinik::create([
            'upload_gambar' => $poliPath,
            'id_rumahsakit' => $rs->id_rumahsakit,
            'nama_poli' => 'Poli Test',
            'lantai' => 1,
            'jam_operasional' => '08:00-16:00',
        ]);

        $this->command->info("Seeded RumahSakit with image: {$rsPath} and Poliklinik with image: {$poliPath} on disk {$diskName}");
    }
}
