<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Dokter;
use Illuminate\Support\Facades\Storage;

$docs = Dokter::latest('created_at')->take(5)->get();
if ($docs->isEmpty()) {
    echo "No dokter found\n";
    exit(0);
}

foreach ($docs as $d) {
    $path = $d->upload_gambar ?? 'NULL';
    $existsMinio = Storage::disk('minio')->exists($path) ? 'yes' : 'no';
    $urlMinio = $path && Storage::disk('minio')->exists($path) ? Storage::disk('minio')->url($path) : 'N/A';
    $existsPublic = Storage::disk('public')->exists($path) ? 'yes' : 'no';
    $urlPublic = $path && Storage::disk('public')->exists($path) ? Storage::disk('public')->url($path) : 'N/A';

    echo "id: {$d->id_dokter} | upload_gambar: {$path} | minio_exists: {$existsMinio} | minio_url: {$urlMinio} | public_exists: {$existsPublic} | public_url: {$urlPublic} | created_at: {$d->created_at}\n";
}
