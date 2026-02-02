<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Dokter;
use App\Models\Kunjungan;
use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Poliklinik;
use App\Models\Resep;
use Filament\Widgets\Widget;

class DashboardStats extends Widget
{
    protected static string $view = 'filament.admin.widgets.dashboard-stats';

    public function getData(): array
    {
        return [
            'dokter' => Dokter::count(),
            'poliklinik' => Poliklinik::count(),
            'pasien' => Pasien::count(),
            'obat' => Obat::count(),
            'kunjungan' => Kunjungan::count(),
            'resep' => Resep::count(),
        ];
    }
}
