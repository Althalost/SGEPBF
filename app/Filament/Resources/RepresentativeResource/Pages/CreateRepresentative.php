<?php

namespace App\Filament\Resources\RepresentativeResource\Pages;

use App\Filament\Resources\RepresentativeResource;
use App\Filament\Resources\StudentResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateRepresentative extends CreateRecord
{
    protected static string $resource = RepresentativeResource::class;

    protected static bool $canCreateAnother = false;

    protected function getRedirectUrl(): string
    {
        return StudentResource::getUrl('create');
    }

    protected function getFormActions(): array
    {
        return array_merge(
            parent::getFormActions(),
            [
                Action::make('skipCreate')
                    ->label(__('The representative is already registered'))
                    ->url(fn (): string => route('filament.admin.resources.students.create'))
                    ->color('primary'),
            ]
        );
    }

}
