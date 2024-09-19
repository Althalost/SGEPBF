<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Pages\CreateRelatedRecord;

class CreateGradeGroup extends CreateRelatedRecord
{
    use NestedPage;

    protected static string $resource = GradeResource::class;

    protected static string $relationship = 'groups';
}