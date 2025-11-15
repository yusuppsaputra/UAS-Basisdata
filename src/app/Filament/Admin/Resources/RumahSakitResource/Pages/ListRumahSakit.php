<?php

namespace App\Filament\Admin\Resources\RumahSakitResource\Pages;

use App\Filament\Admin\Resources\RumahSakitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRumahSakit extends ListRecords
{
    protected static string $resource = RumahSakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Rumah Sakit')
                ->icon('heroicon-m-plus'),
        ];
    }
}
