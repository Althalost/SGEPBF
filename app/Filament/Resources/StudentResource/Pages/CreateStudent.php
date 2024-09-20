<?php

namespace App\Filament\Resources\StudentResource\Pages;

use App\Filament\Resources\StudentResource;
use Filament\Actions;
use Filament\Actions\Action as ActionsAction;
use Filament\Actions\Modal\Actions\Action;
use Filament\Resources\Pages\CreateRecord;
use Guava\FilamentNestedResources\Concerns\NestedPage;

class CreateStudent extends CreateRecord
{

    use NestedPage;

    protected static string $resource = StudentResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit', ['record' => $this->record]);
    }

    protected function getCreateFormAction(): ActionsAction
    {
        return parent::getCreateFormAction()
            ->submit(null)
            ->requiresConfirmation()
            ->modalHeading('Create Student')
            ->modalDescription('You are creating a student record, make sure to add the respective relationship with representative after create it, in the tabla under this form.')
            ->modalSubmitActionLabel('Yes, I got it')
            ->action(function () {
                $this->closeActionModal();
                $this->create();
            });
    }
}
