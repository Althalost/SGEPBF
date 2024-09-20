<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditGrade extends EditRecord
{

    use NestedPage;

    protected static string $resource = GradeResource::class;

    /* protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    } */

    public function getHeading(): string
    {
        $url = url()->current();
        //$url = str_replace(["http://127.0.0.1:8000/admin/grades/", "/groups"], "", $url);
        $url = explode("/", $url);
        return __('Viewing groups for the grade: ' . $url[5]);
    }

    protected function getFormActions(): array
    {
        return [
            //$this->getSaveFormAction(),
            //$this->getCancelFormAction(),
        ];
    }
}
