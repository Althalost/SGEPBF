<?php

namespace App\Filament\Resources\GroupResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Concerns\NestedRelationManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentsRelationManager extends RelationManager
{

    use NestedRelationManager;

    protected static string $relationship = 'students';

    protected static bool $shouldRegisterNavigation = true;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->modelLabel(__('Student'))
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('Full Name')),
                Tables\Columns\TextColumn::make('representatives.full_name')
                    ->label(__('Representatives')),
                Tables\Columns\TextColumn::make('representatives.phone')
                    ->label(__('Phone')),
                Tables\Columns\TextColumn::make('group.grade.code')->suffix('° grado')
                    ->label(__('Grade')),
                Tables\Columns\TextColumn::make('group.section.code')
                    ->label(__('section')),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->label(__('Create Student'))
                ->url(fn (): string => route('filament.admin.resources.representatives.create')),
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
