<?php

namespace App\Filament\Resources\StudentResource\RelationManagers;

use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Infolists;
use Filament\Infolists\Infolist;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentRecordRelationManager extends RelationManager
{
    protected static string $relationship = 'studentRecord';

    public function infolist(Infolist $infolist): Infolist
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('student_grade')
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
            ->headerActions([
                //,
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
