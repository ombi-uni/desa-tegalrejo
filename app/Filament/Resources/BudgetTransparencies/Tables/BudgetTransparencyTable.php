<?php

namespace App\Filament\Resources\BudgetTransparencies\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BudgetTransparencyTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('year')->label('Tahun')->sortable(),
                TextColumn::make('category')->label('Kategori')->badge(),
                TextColumn::make('title')->label('Pos Anggaran')->searchable(),
                TextColumn::make('amount')->label('Nominal')->money('IDR')->sortable(),
                TextColumn::make('pdf_file')->label('Dokumen PDF')->formatStateUsing(fn ($state) => $state ? 'Ada PDF' : 'Tidak Ada'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
