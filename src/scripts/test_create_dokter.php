<?php

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dokter;
use App\Models\Poliklinik;
use App\Models\RumahSakit;

$rs = RumahSakit::first();
$p = Poliklinik::first();
if (! $rs || ! $p) {
    echo "No Rumah Sakit or Poliklinik found, aborting\n";
    exit(1);
}

$d = new Dokter;
$d->id_rumahsakit = $rs->id_rumahsakit;
$d->id_poli = $p->id_poli;
$d->nama_dokter = 'Test Dokter ' . time();
$d->spesialisasi = 'Cardiology';
$d->no_str = 'STR' . rand(1000, 9999);
$d->no_telepon = '08123456789';
$d->upload_gambar = 'dokter/test.png';
$d->save();

echo "Created Dokter with id: {$d->id_dokter} upload_gambar: {$d->upload_gambar}\n";
