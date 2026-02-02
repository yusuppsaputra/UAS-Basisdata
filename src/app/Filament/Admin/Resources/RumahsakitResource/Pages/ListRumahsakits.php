<?php

namespace App\Filament\Admin\Resources\RumahsakitResource\Pages;

use App\Filament\Admin\Resources\RumahsakitResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRumahsakits extends ListRecords
{
    protected static string $resource = RumahsakitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
