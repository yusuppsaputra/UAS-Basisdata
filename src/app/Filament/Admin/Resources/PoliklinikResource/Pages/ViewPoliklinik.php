<?php

namespace App\Filament\Admin\Resources\PoliklinikResource\Pages;

use App\Filament\Admin\Resources\PoliklinikResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPoliklinik extends ViewRecord
{
    protected static string $resource = PoliklinikResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
