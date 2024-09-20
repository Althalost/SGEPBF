<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class ListGrades extends ListRecords
{

    use NestedPage;

    protected static string $resource = GradeResource::class;

    /* protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    } */
}
