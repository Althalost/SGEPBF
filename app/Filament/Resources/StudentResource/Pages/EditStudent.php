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

    public function getRecord(): Student
    {
        return Student::with('repesentatives')->findOrFail($this->recordId);
    }


}
