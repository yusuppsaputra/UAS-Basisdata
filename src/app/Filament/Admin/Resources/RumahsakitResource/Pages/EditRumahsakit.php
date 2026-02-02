<?php

namespace App\Filament\Admin\Resources\RumahsakitResource\Pages;

use App\Filament\Admin\Resources\RumahsakitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRumahsakit extends EditRecord
{
    protected static string $resource = RumahsakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
