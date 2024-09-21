<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteResource\Pages;
use App\Filament\Resources\NoteResource\RelationManagers;
use App\Models\Note;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false; 

    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Grid::make()
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
                Forms\Components\TextInput::make('grade_code')
                    ->required()
                    ->maxLength(20)
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
            ])
            ->columns([
                'lg' => 12, 
                'md' => 12, 
                'sm' => 1
            ]), 
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNote::route('/create'),
            'edit' => Pages\EditNote::route('/{record}/edit'),
        ];
    }
}
