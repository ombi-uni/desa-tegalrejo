<?php

namespace App\Filament\Resources\Statistics\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatisticTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('population_count')->label('Jumlah Penduduk'),
                TextColumn::make('building_count')->label('Jumlah Bangunan'),
                TextColumn::make('facility_count')->label('Jumlah Fasilitas Umum'),
                TextColumn::make('worship_place_count')->label('Tempat Ibadah'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
