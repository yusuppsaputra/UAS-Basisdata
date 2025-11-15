<?php

namespace App\Filament\Admin\Resources\PasienResource\Pages;

use App\Filament\Admin\Resources\PasienResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPasien extends ListRecords
{
    protected static string $resource = PasienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Daftar Pasien Baru')
                ->icon('heroicon-m-plus'),
        ];
    }
}
