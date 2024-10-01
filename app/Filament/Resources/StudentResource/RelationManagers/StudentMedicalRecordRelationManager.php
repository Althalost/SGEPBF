<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentMedicalRecordRelationManager extends RelationManager
{
    protected static string $relationship = 'StudentMedicalRecord';

    public function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('medical_condition')
                ->required()
                ->label('Medical Condition'),
            Forms\Components\Textarea::make('treatment')
                ->label('Treatment')
                ->nullable(),
            Forms\Components\Textarea::make('notes')
                ->label('Note')
                ->nullable(),
            Forms\Components\Textarea::make('allergies')
                ->label('Allergies')
                ->nullable(),
            Forms\Components\Textarea::make('medications')
                ->label('Medications')
                ->nullable(),
            Forms\Components\Textarea::make('vaccines')
                ->label('Vaccines')
                ->nullable(),
        ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
        ->schema([
            Forms\Components\TextInput::make('medical_condition')
                ->required()
                ->label('Medical Condition'),
            Forms\Components\Textarea::make('treatment')
                ->label('Treatment')
                ->nullable(),
            Forms\Components\Textarea::make('notes')
                ->label('Note')
                ->nullable(),
            Forms\Components\Textarea::make('allergies')
                ->label('Allergies')
                ->nullable(),
            Forms\Components\Textarea::make('medications')
                ->label('Medications')
                ->nullable(),
            Forms\Components\Textarea::make('vaccines')
                ->label('Vaccines')
                ->nullable(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('medical_condition')
            ->columns([
                Tables\Columns\TextColumn::make('medical_condition')->label('Medical Condition'),
                Tables\Columns\TextColumn::make('treatment')->label('Treatment') ->limit(20),
                Tables\Columns\TextColumn::make('notes')->label('Notes') ->limit(12),
                Tables\Columns\TextColumn::make('allergies')->label('Allergies') ->limit(12),
                Tables\Columns\TextColumn::make('medications')->label('Medications')->wrap(),
                Tables\Columns\TextColumn::make('vaccines')->label('Vaccines') ->limit(20),
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
