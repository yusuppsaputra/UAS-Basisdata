<?php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$p = App\Models\Poliklinik::latest()->first();
if ($p) {
    echo 'id: ' . $p->id_poli . "\n";
    echo 'name: ' . $p->nama_poli . "\n";
    echo 'image: ' . ($p->upload_gambar ?? 'NULL') . "\n";
} else {
    echo "no poliklinik\n";
}
