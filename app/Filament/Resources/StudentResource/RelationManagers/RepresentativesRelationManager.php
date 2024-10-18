<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use App\Models\Representative;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RepresentativesRelationManager extends RelationManager
{
    protected static string $relationship = 'representatives';

    public static function getModelLabel(): string
    {
        return __('Representative');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Representatives');
    }

    protected $listeners = ['refreshRepresentativeTable' => '$refresh'];

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('full_name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('relationship')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('ci')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('address')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('edit');
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('full_name')
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('Full Name')),
                Tables\Columns\TextColumn::make('pivot.relationship')
                    ->label(__('Relationship')),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('Phone')),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address')),
            ])
            ->modelLabel(__('Representative'))
            ->pluralModelLabel(__('Representatives'))
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label(__('Add Representative')),
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
