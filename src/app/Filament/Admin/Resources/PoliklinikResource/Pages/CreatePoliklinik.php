<?php

namespace App\Filament\Admin\Resources\PoliklinikResource\Pages;

use App\Filament\Admin\Resources\PoliklinikResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePoliklinik extends CreateRecord
{
    protected static string $resource = PoliklinikResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
