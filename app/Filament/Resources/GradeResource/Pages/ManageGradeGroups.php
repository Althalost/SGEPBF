<?php

namespace App\Filament\Resources\GradeResource\Pages;

use App\Filament\Resources\GradeResource;
use App\Filament\Resources\GroupResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\ManageRelatedRecords;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Concerns\NestedPage;
use Guava\FilamentNestedResources\Concerns\NestedRelationManager;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

use function PHPSTORM_META\expectedArguments;

class ManageGradeGroups extends ManageRelatedRecords
{
    use NestedPage;
    use NestedRelationManager;

    protected static string $resource = GradeResource::class;

    protected static string $relationship = 'groups';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

   
    public function getHeading(): string
    {
        $url = url()->current();
        $url = explode("/", $url);
        $title = __('Viewing groups for the grade: ') . $url[5];
        return $title;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('grade.code')->suffix('° grado'),
                Tables\Columns\TextColumn::make('section.code'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                   Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}