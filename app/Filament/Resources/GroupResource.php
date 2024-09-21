<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GroupResource\Pages;
use App\Filament\Resources\GroupResource\RelationManagers;
use App\Filament\Resources\GroupResource\RelationManagers\StudentsRelationManager;
use App\Models\Group;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class GroupResource extends Resource
{

    use NestedResource;

    protected static ?string $model = Group::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('classroom')
                ->maxLength(60)
                ->hiddenOn('edit'),
                Forms\Components\Select::make('grade_id')
                ->relationship('grade', 'code')
                ->searchable()
                ->preload()
                ->required()
                ->hiddenOn('edit'),
                Forms\Components\Select::make('section_id')
                ->relationship('section', 'code')
                ->searchable()
                ->preload()
                ->required()
                ->hiddenOn('edit'),
                Forms\Components\Select::make('teacher_id')
                ->relationship('teacher', 'full_name')
                ->searchable()
                ->preload()
                ->required()
                ->hiddenOn('edit'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('grade.code')->label('Grados')->suffix('° grado'),
                Tables\Columns\TextColumn::make('students_count')->counts('students')->label('N° de grupos'),
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
            StudentsRelationManager::class,
        ];
    }

    public static function getAncestor() : ?Ancestor
    {
        // Configure the ancestor (parent) relationship here
        return Ancestor::make(
            'groups', // Relationship name
            'grade', // Inverse relationship name
        );
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListGroups::route('/'),
            'create' => Pages\CreateGroup::route('/create'),
            'edit' => Pages\EditGroup::route('/{record}/edit'),

             // create child pages
             'students.create' => Pages\CreateGroupStudent::route('/{record}/students/create'),
        ];
    }
}
