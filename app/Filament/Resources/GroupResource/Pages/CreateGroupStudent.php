<?php

namespace App\Filament\Resources\GroupResource\Pages;

use App\Filament\Resources\GroupResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Pages\CreateRelatedRecord;

class CreateGroupStudent extends CreateRelatedRecord
{
    use NestedPage;

    protected static string $resource = GroupResource::class;

    protected static string $relationship = 'students';
}