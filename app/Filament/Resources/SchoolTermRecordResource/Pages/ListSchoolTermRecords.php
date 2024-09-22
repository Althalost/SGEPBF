<?php

namespace App\Filament\Resources\SchoolTermRecordResource\Pages;

use App\Filament\Resources\SchoolTermRecordResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchoolTermRecords extends ListRecords
{
    protected static string $resource = SchoolTermRecordResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
