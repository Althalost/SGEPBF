<?php

namespace App\Filament\Resources\RepresentativeResource\Pages;

use App\Filament\Resources\RepresentativeResource;
use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRepresentative extends CreateRecord
{
    protected static string $resource = RepresentativeResource::class;

    protected function getRedirectUrl(): string
    {
        return StudentResource::getUrl('create');
    }

}
