<?php

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$docs = \App\Models\Dokter::latest('created_at')->take(10)->get();
foreach ($docs as $d) {
    echo "id: {$d->id_dokter} | nama: {$d->nama_dokter} | no_str: {$d->no_str} | upload_gambar: " . ($d->upload_gambar ?? 'NULL') . " | created_at: {$d->created_at}\n";
}
