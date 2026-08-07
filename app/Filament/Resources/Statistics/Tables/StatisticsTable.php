<?php

namespace App\Filament\Resources\Statistics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class StatisticsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('population_count')->label('Jumlah Penduduk')->numeric(),
                TextColumn::make('building_count')->label('Jumlah KK / Bangunan')->numeric(),
                TextColumn::make('facility_count')->label('Fasilitas Umum')->numeric(),
                TextColumn::make('worship_place_count')->label('Tempat Ibadah')->numeric(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
