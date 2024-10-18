<?php

namespace App\Filament\Resources\GradeResource\RelationManagers;

use App\Filament\Resources\GroupResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Concerns\NestedRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroupsRelationManager extends RelationManager
{

    use NestedRelationManager;

    protected static string $relationship = 'groups';

    public static string $nestedResource = GroupResource::class;

    public static function getModelLabel(): string
    {
        return __('Group');
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
            ->modelLabel(__('Group'))
            ->pluralModelLabel(__('Groups'))
            ->columns([
                Tables\Columns\TextColumn::make('grade_section')
                ->label(__('Grade/Section'))
                ->getStateUsing(fn ($record) => $record->grade->code . '° grado - "' . $record->section->code . '"'),
                Tables\Columns\TextColumn::make('students_count')->counts('students')->label(__('Students')),
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
