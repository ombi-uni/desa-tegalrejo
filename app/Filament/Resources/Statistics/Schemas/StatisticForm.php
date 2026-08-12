<?php

namespace App\Filament\Resources\Statistics\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StatisticForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('🏘️ Statistik Desa — Widget Beranda')
                    ->description('Angka-angka ini ditampilkan pada widget statistik di halaman Beranda. Untuk data kependudukan lengkap (agama, pendidikan, pekerjaan, dll.) silakan kunjungi menu Data Kependudukan.')
                    ->schema([
                        TextInput::make('population_count')
                            ->label('Jumlah Penduduk Desa (Jiwa)')
                            ->numeric()
                            ->required(),
                        TextInput::make('building_count')
                            ->label('Jumlah Bangunan Tempat Tinggal (Unit)')
                            ->numeric()
                            ->required(),
                        TextInput::make('facility_count')
                            ->label('Jumlah Fasilitas Umum (Makam, Lapangan, Balai, dll)')
                            ->numeric()
                            ->required(),
                        TextInput::make('worship_place_count')
                            ->label('Jumlah Tempat Ibadah (Masjid, Mushola, dll)')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}
