<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\RepresentativeResource;
use App\Filament\Resources\StudentResource;
use App\Models\Representative;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Illuminate\Database\Eloquent\Model;

class ListStudents extends ListRecords
{

    use NestedPage;

    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label(__('Create Student'))
            ->url(fn (): string => route('filament.admin.resources.representatives.create')),
        ];
    }
}
