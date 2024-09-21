<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use App\Models\Student;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditStudent extends EditRecord
{

    use NestedPage;

    protected static string $resource = StudentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
            ->after(function () {
                // Runs after the form fields are saved to the database.
            }),
        ];
    }


    protected function afterSave(): void
    {
        $this->dispatch('refreshRepresentativeTable');
    }

    public function getRecord(): Student
    {
        return Student::with('representatives')->findOrFail($this->record->id);
    }


    protected function getActions(): array
    {
        return [
            \Filament\Forms\Components\Actions\Action::make('createNote')
                ->label('Crear Nota')
                ->url(fn () => route('filament.resources.notes.create', ['student' => $this->record->id])),
        ];
    }

}
