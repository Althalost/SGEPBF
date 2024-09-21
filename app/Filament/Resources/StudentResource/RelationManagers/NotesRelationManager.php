<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use App\Models\Grade;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotesRelationManager extends RelationManager
{
    protected static string $relationship = 'notes';

    public function create(Student $student)
    {
        return view('filament.resources.notes.create', ['student' => $student]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Title')
                    ->required()
                    ->maxLength(255)
                    ->columnSpan([
                        'lg' => 5, 
                        'md' => 8, 
                        'sm' => 1
                    ]),
                Forms\Components\Select::make('grade_code')
                    ->label('Student Grade')
                    ->preload()
                    ->required()
                    ->options(Grade::orderBy('id', 'ASC')->pluck('code', 'code'))
                    ->columnSpan([
                        'md' => 4, 
                        'md' => 3, 
                        'sm' => 1
                    ]),
                Forms\Components\Textarea::make('body')
                    ->required()
                    ->rows(10)
                    ->columnSpan([
                        'lg' => 12, 
                        'md' => 12, 
                        'sm' => 1
                    ]), 
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
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
