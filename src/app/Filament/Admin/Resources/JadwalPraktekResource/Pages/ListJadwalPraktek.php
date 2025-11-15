<?php

namespace App\Filament\Admin\Resources\JadwalPraktekResource\Pages;

use App\Filament\Admin\Resources\JadwalPraktekResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJadwalPraktek extends ListRecords
{
    protected static string $resource = JadwalPraktekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Jadwal')
                ->icon('heroicon-m-plus'),
        ];
    }
}
