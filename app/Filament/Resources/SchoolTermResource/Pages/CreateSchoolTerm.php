<?php

namespace App\Filament\Resources\SchoolTermResource\Pages;

use App\Filament\Resources\SchoolTermResource;
use App\Models\SchoolTerm;
use App\Models\SchoolTermRecord;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSchoolTerm extends CreateRecord
{
    protected static string $resource = SchoolTermResource::class;

}
