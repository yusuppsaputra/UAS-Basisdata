<?php

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

$docs = \App\Models\Dokter::latest('created_at')->take(10)->get();
foreach ($docs as $d) {
    $path = $d->upload_gambar;
    $display = ($path && Storage::disk('public')->exists($path)) ? Storage::disk('public')->url($path) : Storage::disk('public')->url('dokter/placeholder.png');
    echo "id: {$d->id_dokter} | upload_gambar: " . ($path ?? 'NULL') . " | display_url: {$display}\n";
}
