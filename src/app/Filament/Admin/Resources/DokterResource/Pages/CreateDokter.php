<?php

namespace App\Filament\Admin\Resources\DokterResource\Pages;

use App\Filament\Admin\Resources\DokterResource;
use Filament\Resources\Pages\CreateRecord;

class CreateDokter extends CreateRecord
{
    protected static string $resource = DokterResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
