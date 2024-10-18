<?php

namespace App\Filament\Resources\GroupResource\Pages;

use App\Filament\Resources\GroupResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class EditGroup extends EditRecord
{

    use NestedPage;

    protected static string $resource = GroupResource::class;


    public function getHeading(): string
    {
        $url = url()->current();
        //$url = str_replace(["http://127.0.0.1:8000/admin/grades/", "/groups"], "", $url);
        $url = explode("/", $url);
        $title = __('Viewing students for the group: ') . $url[5];
        return $title;
    }

    protected function getFormActions(): array
    {
        return [
            //$this->getSaveFormAction(),
            //$this->getCancelFormAction(),
        ];
    }
   

}
