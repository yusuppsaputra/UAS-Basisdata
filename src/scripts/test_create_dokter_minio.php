<?php

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dokter;
use App\Models\RumahSakit;
use App\Models\Poliklinik;
use Illuminate\Support\Facades\Storage;

// Ensure at least one RumahSakit and Poliklinik
$rs = RumahSakit::first();
if (! $rs) {
    $rs = RumahSakit::create([
        'nama' => 'RS Test Auto',
        'alamat' => 'Jl Test',
        'kota' => 'Kota Test',
        'provinsi' => 'Provinsi Test',
        'no_telepon' => '081234567890',
        'kelas_rumah_sakit' => 'C',
    ]);
}

$p = Poliklinik::where('id_rumahsakit', $rs->id_rumahsakit)->first();
if (! $p) {
    $p = Poliklinik::create([
        'id_rumahsakit' => $rs->id_rumahsakit,
        'nama_poli' => 'Poli Test Auto',
        'lantai' => 1,
        'jam_operasional' => '08:00-16:00',
    ]);
}

// Download sample image
$contents = @file_get_contents('https://picsum.photos/1200/800');
if ($contents === false) {
    $contents = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII=');
}

$filename = 'dokter/test-' . uniqid() . '.jpg';
Storage::disk('minio')->put($filename, $contents);

$d = Dokter::create([
    'id_rumahsakit' => $rs->id_rumahsakit,
    'id_poli' => $p->id_poli,
    'nama_dokter' => 'Dokter MinIO ' . uniqid(),
    'spesialisasi' => 'General',
    'no_str' => 'STR' . rand(10000, 99999),
    'no_telepon' => '0812' . rand(10000000, 99999999),
    'upload_gambar' => $filename,
]);

echo "Created Dokter id={$d->id_dokter} upload_gambar={$d->upload_gambar}\n";
echo 'minio_exists: ' . (Storage::disk('minio')->exists($filename) ? 'yes' : 'no') . "\n";
echo 'url: ' . Storage::disk('minio')->url($filename) . "\n";
