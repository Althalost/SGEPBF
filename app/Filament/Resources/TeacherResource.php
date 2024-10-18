<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('Teacher');
    }

    public static function getNavigationLabel(): string
    {
        return __('Teacher Management');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('full_name')->label(__(key: 'Full Name'))
                ->required()
                ->maxLength(60),
                Forms\Components\TextInput::make('ci')
                ->required()
                ->maxLength(20),
                Forms\Components\TextInput::make('email')->label(__(key: 'Email'))
                ->required()
                ->maxLength(30),
                Forms\Components\TextInput::make('phone')->label(__(key: 'Phone'))
                ->required()
                ->maxLength(20),
                Forms\Components\TextInput::make(name: 'address')->label(__(key: 'Address'))
                ->required()
                ->maxLength(60),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__('Nombre Completo')),
                Tables\Columns\TextColumn::make('email')
                    ->label(__('Email')),
                Tables\Columns\TextColumn::make('phone')
                    ->label(__('Phone')),
                Tables\Columns\TextColumn::make('address')
                    ->label(__('Address')),
                Tables\Columns\TextColumn::make('groups.grade.code')
                    ->label(__('Grade'))
                    ->suffix('° grado'),
                Tables\Columns\TextColumn::make('groups.section.code')
                    ->label(__('section')),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
}
