<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GradeResource\Pages;
use App\Filament\Resources\GradeResource\RelationManagers;
use App\Filament\Resources\GradeResource\RelationManagers\GroupsRelationManager;
use App\Models\Grade;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Pages\Page;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GradeResource extends Resource
{

    use NestedResource;

    protected static ?string $model = Grade::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false; 

    public static function getModelLabel(): string
    {
        return __('Grade');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('code')
                ->required()
                ->maxLength(10)
                ->hidden(),
            ])->disabled();
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('code')->label(__('Grades'))->suffix(__('° grado')),
                Tables\Columns\TextColumn::make('groups_count')->counts('groups')->label(__('N° of Groups')),
                Tables\Columns\TextColumn::make('groups.section.code')->label(__('section')),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            GroupsRelationManager::class,
        ];
    }


    public static function getAncestor(): ?Ancestor
    {
        return null;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGrades::route('/'),
            'create' => Pages\CreateGrade::route('/create'),
            'edit' => Pages\EditGrade::route('/{record}/edit'),

            // In case of relation page.
            // Make sure the name corresponds to the name of your actual relationship on the model.
             'groups' => Pages\ManageGradeGroups::route('/{record}/groups'),
 
            // Needed to create child records
            // The name should be '{relationshipName}.create':
            'groups.create' => Pages\CreateGradeGroup::route('/{record}/groups/create'),
        ];
    }
/* 
    public static function getRecordSubNavigation(Page $page): array
    {
        return $page->generateNavigationItems([
            Pages\ManageGradeGroups::class,
            Pages\EditGrade::class,
        ]);
    } */

}
