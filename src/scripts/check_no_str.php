<?php

require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$val = 'STR001-2023';
$count = \App\Models\Dokter::where('no_str', $val)->count();
echo "Found {$count} record(s) with no_str = {$val}\n";
