<?php

namespace App\Filament\Admin\Resources\RumahSakitResource\Pages;

use App\Filament\Admin\Resources\RumahSakitResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRumahSakit extends ViewRecord
{
    protected static string $resource = RumahSakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
