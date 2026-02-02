<?php

namespace App\Filament\Admin\Resources\PoliklinikResource\Pages;

use App\Filament\Admin\Resources\PoliklinikResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePoliklinik extends CreateRecord
{
    protected static string $resource = PoliklinikResource::class;

    protected function getRedirectUrl(): string
    {
        // Use session flash because notify() is not available on this Page class
        session()->flash('success', 'Poliklinik berhasil dibuat.');

        return static::getResource()::getUrl('index');
    }
}
