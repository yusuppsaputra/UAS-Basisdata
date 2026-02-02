<?php

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$path = storage_path('app/public/poliklinik/test.png');
if (! is_dir(dirname($path))) {
    mkdir(dirname($path), 0755, true);
}
file_put_contents($path, base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR4nGNgYAAAAAMAASsJTYQAAAAASUVORK5CYII='));

$p = App\Models\Poliklinik::latest()->first();
$p->upload_gambar = 'poliklinik/test.png';
$p->save();

echo 'attached: ' . $p->upload_gambar . PHP_EOL;
