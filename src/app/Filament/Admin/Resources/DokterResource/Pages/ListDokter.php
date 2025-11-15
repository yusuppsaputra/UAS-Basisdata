<?php

namespace App\Filament\Admin\Resources\DokterResource\Pages;

use App\Filament\Admin\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDokter extends ListRecords
{
    protected static string $resource = DokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Tambah Dokter')
                ->icon('heroicon-m-plus'),
        ];
    }
}
