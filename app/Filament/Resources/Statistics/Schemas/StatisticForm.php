<?php

namespace App\Filament\Resources\Statistics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class StatisticForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('population_count')
                    ->label('Jumlah Penduduk Desa (Jiwa)')
                    ->numeric()
                    ->required(),
                TextInput::make('building_count')
                    ->label('Jumlah Bangunan (Unit)')
                    ->numeric()
                    ->required(),
                TextInput::make('facility_count')
                    ->label('Jumlah Fasilitas Umum (Makam, Lapangan, dll)')
                    ->numeric()
                    ->required(),
                TextInput::make('worship_place_count')
                    ->label('Jumlah Tempat Ibadah (Masjid, Gereja, dll)')
                    ->numeric()
                    ->required(),
            ]);
    }
}
