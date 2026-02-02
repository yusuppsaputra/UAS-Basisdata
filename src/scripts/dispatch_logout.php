<?php

require __DIR__ . '/../vendor/autoload.php';

use Illuminate\Auth\Events\Logout;

$u = App\Models\User::where('email', 'admin@rumahsakit.com')->first();
if (! $u) {
    echo "User not found\n";
    exit(1);
}

event(new Logout($u));

echo "Logout event dispatched for {$u->email}\n";
