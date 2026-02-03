<?php

namespace Database\Seeders;

use App\Models\Dokter;
use App\Models\Poliklinik;
use App\Models\RumahSakit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class TestDokterSeeder extends Seeder
{
    public function run(): void
    {
        $rs = RumahSakit::first();
        if (! $rs) {
            $rs = RumahSakit::create([
                'nama' => 'RS Seeder',
                'alamat' => 'Jl Seeder',
                'kota' => 'Kota',
                'provinsi' => 'Provinsi',
                'no_telepon' => '081234567890',
                'kelas_rumah_sakit' => 'C',
            ]);
        }

        $p = Poliklinik::where('id_rumahsakit', $rs->id_rumahsakit)->first();
        if (! $p) {
            $p = Poliklinik::create([
                'id_rumahsakit' => $rs->id_rumahsakit,
                'nama_poli' => 'Poli Seeder',
                'lantai' => 1,
                'jam_operasional' => '08:00-16:00',
            ]);
        }

        $contents = @file_get_contents('https://picsum.photos/1200/800');
        if ($contents === false) {
            $contents = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=');
        }

        $filename = 'dokter/test-' . uniqid() . '.jpg';
        Storage::disk('minio')->put($filename, $contents);

        Dokter::create([
            'id_rumahsakit' => $rs->id_rumahsakit,
            'id_poli' => $p->id_poli,
            'nama_dokter' => 'Dokter Seeder ' . uniqid(),
            'spesialisasi' => 'Seeder',
            'no_str' => 'STR' . rand(1000,9999),
            'no_telepon' => '0812' . rand(10000000,99999999),
            'upload_gambar' => $filename,
        ]);

        $this->command->info("Created dokter with image {$filename}");
    }
}
