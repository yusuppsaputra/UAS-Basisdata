<?php

namespace App\Filament\Admin\Resources\DokterResource\Pages;

use App\Filament\Admin\Resources\DokterResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewDokter extends ViewRecord
{
    protected static string $resource = DokterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
