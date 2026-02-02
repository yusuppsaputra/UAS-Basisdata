<?php

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$path = storage_path('app/public/dokter/placeholder.png');
if (! is_dir(dirname($path))) {
    mkdir(dirname($path), 0755, true);
}
// Tiny 1x1 transparent PNG
file_put_contents($path, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAAWgmWQ0AAAAASUVORK5CYII='));

if (\Illuminate\Support\Facades\Storage::disk('public')->exists('dokter/placeholder.png')) {
    echo "Placeholder created at: dok ter/placeholder.png\n";
} else {
    echo "Failed to create placeholder\n";
}
