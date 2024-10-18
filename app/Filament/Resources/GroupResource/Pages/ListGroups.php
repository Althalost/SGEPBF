<?php

namespace App\Filament\Resources\GroupResource\Pages;

use App\Filament\Resources\GroupResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Illuminate\Contracts\Support\Htmlable;

class ListGroups extends ListRecords
{

    use NestedPage;

    protected static string $resource = GroupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\EditAction::make(),
        ];
    }

    public function getSubheading(): string|Htmlable|null
    {
        return __('Viewing groups for the grade: ');
    }

}
