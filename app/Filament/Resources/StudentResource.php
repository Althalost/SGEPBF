<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Filament\Resources\StudentResource\RelationManagers\NotesRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\RepresentativesRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\StudentMedicalRecordRelationManager;
use App\Filament\Resources\StudentResource\RelationManagers\StudentRecordRelationManager;
use App\Models\Grade;
use App\Models\Group;
use App\Models\Representative;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Guava\FilamentNestedResources\Ancestor;
use Guava\FilamentNestedResources\Concerns\NestedResource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    use NestedResource;
    
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Forms\Components\TextInput::make('full_name')
                ->label(__(key: 'Full Name'))
                ->required()
                ->maxLength(60),
                Forms\Components\TextInput::make('ci')
                ->required()
                ->maxLength(20),
                Forms\Components\DatePicker::make('date_of_birth')
                ->label(__(key: 'Date of birth'))
                ->required(),
                Forms\Components\Select::make('gender')
                ->label(__(key: 'Gender'))
                ->options([
                    01 => __('Male'),
                    02 => __('Female')
                ])
                ->required(),
                Forms\Components\DatePicker::make('join_date')
                ->label(__(key: 'Join date')),
                Forms\Components\Select::make('group_id')
                    ->label(__(key: 'Group'))
                    ->relationship('group' , 'id' )
                    ->options(function () {
                        return Group::with(['grade', 'section'])->get()->mapWithKeys(function ($group) {
                            return [$group->id => $group->grade->code . '° ' . __('Grade') . ' - ' . $group->section->code . '"'];
                        });
                    })
                    ->searchable()
                    ->preload()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('classroom')
                        ->maxLength(60),
                        Forms\Components\Select::make('grade_id')
                        ->relationship('grade', 'code')
                        ->searchable()
                        ->preload()
                        ->required(),
                        Forms\Components\Select::make('section_id')
                        ->relationship('section', 'code')
                        ->searchable()
                        ->preload()
                        ->required(),
                        Forms\Components\Select::make('teacher_id')
                        ->relationship('teacher', 'full_name')
                        ->searchable()
                        ->preload()
                        ->required(),
                    
                ])
                ->required(),
             
                Select::make('representatives')
                    ->relationship('representatives', 'full_name')
                    ->label(__(key: 'Representatives'))
                    ->placeholder(__('add a representative'))
                    ->searchable()
                    ->multiple()
                    ->options(Representative::orderBy('id', 'DESC')->pluck('full_name', 'id'))
                    ->default(fn () => Representative::latest('id')->limit(1)->get()->pluck('id')->toArray())
                    //->default([Representative::latest()->first()->id => Representative::latest()->first()->full_name])
                    //->default(Representative::latest()->first()->id)
                    ->preload()
                    ->required(),
            

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                Tables\Columns\TextColumn::make('full_name')
                    ->label(__(key: 'Full Name'))
                    ->searchable(),
                //Tables\Columns\TextColumn::make('students.full_name'),
                Tables\Columns\TextColumn::make('representatives.full_name')
                    ->label(__(key: 'Representatives'))
                    ->placeholder('without registered representative.')
                    ->wrap(),
                Tables\Columns\TextColumn::make('representatives.phone')
                    ->label(__(key: 'Phone')),
                Tables\Columns\TextColumn::make('representatives.address')
                    ->label(__(key: 'Address')),
                Tables\Columns\TextColumn::make('group.grade.code')
                    ->label(__(key: 'Grade'))
                    ->suffix('° grado')
                    ->sortable(),
                Tables\Columns\TextColumn::make('group.section.code')
                    ->label(__(key: 'section')),
            ])
            ->defaultSort('group.grade.code','asc')
            ->searchPlaceholder('Search (Ci, Name)')
            ->striped()
            ->recordUrl(fn (Model $record): 
                    string => StudentResource::getUrl('edit', ['record' => $record]))
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            RepresentativesRelationManager::class,
            NotesRelationManager::class,
            StudentRecordRelationManager::class,
            StudentMedicalRecordRelationManager::class,
        ];
    }

    public static function getAncestor() : ?Ancestor
    {
        // Configure the ancestor (parent) relationship here
        return Ancestor::make(
            'students', // Relationship name
            'group', // Inverse relationship name
        );
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'view' => Pages\ViewStudent::route('/{record}'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),

        ];
    }
}
