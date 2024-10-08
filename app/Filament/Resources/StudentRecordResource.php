<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentRecordResource\Pages;
use App\Filament\Resources\StudentRecordResource\RelationManagers;
use App\Models\StudentRecord;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentRecordResource extends Resource
{
    protected static ?string $model = StudentRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static bool $shouldRegisterNavigation = false; 

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
              /*   Forms\Components\TextInput::make('full_name')
                ->required()
                ->maxLength(60),
                Forms\Components\TextInput::make('ci')
                ->required()
                ->maxLength(20),
                Forms\Components\TextInput::make('representative_full_name')
                ->required()
                ->maxLength(60),
                Forms\Components\TextInput::make('representative_ci')
                ->required()
                ->maxLength(20),
                Forms\Components\DatePicker::make('date_of_birth')
                ->required(),
                Forms\Components\Select::make('gender')
                ->options([
                    01 => 'Male',
                    02 => 'Female'
                ])
                ->required(),
                Forms\Components\DatePicker::make('join_date')
                ->required(),
                Forms\Components\TextInput::make('grade_code')
                ->required(),
 */
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Infolists\Components\TextEntry::make('full_name'),
                Infolists\Components\TextEntry::make('ci'),
                Infolists\Components\TextEntry::make('grade_code')
                    ->label('Grade')
                    ->suffix('° grado'),
                Infolists\Components\TextEntry::make('section_code')
                    ->label('Section'),
                Infolists\Components\TextEntry::make('representative_full_name')
                    ->columnSpanFull(),
                Infolists\Components\TextEntry::make('representative_ci')
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')->searchable(),
                Tables\Columns\TextColumn::make('ci')->searchable(),
                Tables\Columns\TextColumn::make('representative_full_name'),
                Tables\Columns\TextColumn::make('representative_ci'),
                Tables\Columns\TextColumn::make('grade_code')
                    ->label('Grade')
                    ->sortable()
                    ->suffix('° Grade'),
                Tables\Columns\TextColumn::make('section_code')
                    ->label('Section')
                    ->sortable(),
                Tables\Columns\TextColumn::make('schoolTerm.start_date')
                    ->label('Term')
                    ->getStateUsing(fn ($record) => $record->schoolTerm->start_date . "," . $record->schoolTerm->end_date)
                    ->formatStateUsing(function ($state) {
                        [$startDate, $endDate] = explode(',', $state);
                        return Carbon::parse($startDate)->format('m/Y') . " - " . Carbon::parse($endDate)->format('m/Y');
                    })
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListStudentRecords::route('/'),
            //'create' => Pages\CreateStudentRecord::route('/create'),
            //'edit' => Pages\EditStudentRecord::route('/{record}/edit'),
            'view' => Pages\ViewStudentRecord::route('/{record}/view'),
        ];
    }
}
