<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolTermResource\Pages;
use App\Filament\Resources\SchoolTermResource\RelationManagers;
use App\Models\SchoolTerm;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolTermResource extends Resource
{
    protected static ?string $model = SchoolTerm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getModelLabel(): string
    {
        return __('School Term');
    }

    public static function getNavigationLabel(): string
    {
        return __('Manage School Terms');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('start_date')
                ->label(__('Start Date'))
                ->required(),
                Forms\Components\DatePicker::make('end_date')
                ->label(__('End Date'))
                ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('start_date')
                    ->label(__('Start Date'))->date()->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                ->label(__('End Date'))->date()->sortable(),
                Tables\Columns\IconColumn::make('active')
                        ->boolean()
                        ->label(__('Active'))
                        ->trueIcon('heroicon-o-check-circle')
                        ->falseIcon('heroicon-o-x-circle'),
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
            'index' => Pages\ListSchoolTerms::route('/'),
            'create' => Pages\CreateSchoolTerm::route('/create'),
            'edit' => Pages\EditSchoolTerm::route('/{record}/edit'),
        ];
    }
}
