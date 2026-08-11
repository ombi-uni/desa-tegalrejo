<?php

namespace App\Filament\Resources\Statistics\Schemas;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class StatisticForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ─── SECTION 1: Ringkasan Kependudukan Utama ──────────────────────
                Section::make('📊 Ringkasan Data Kependudukan Utama')
                    ->description('Data pokok jumlah penduduk, KK, dan pembagian wilayah RT/RW Desa Tegalrejo.')
                    ->schema([
                        TextInput::make('population_count')
                            ->label('Total Jumlah Penduduk (Jiwa)')
                            ->numeric()
                            ->prefix('👥')
                            ->required(),
                        TextInput::make('household_count')
                            ->label('Jumlah Kepala Keluarga (KK)')
                            ->numeric()
                            ->prefix('🏠')
                            ->required(),
                        TextInput::make('male_count')
                            ->label('Jumlah Penduduk Laki-laki (Jiwa)')
                            ->numeric()
                            ->prefix('♂')
                            ->required(),
                        TextInput::make('female_count')
                            ->label('Jumlah Penduduk Perempuan (Jiwa)')
                            ->numeric()
                            ->prefix('♀')
                            ->required(),
                        TextInput::make('rt_count')
                            ->label('Jumlah RT (Rukun Tetangga)')
                            ->numeric()
                            ->required(),
                        TextInput::make('rw_count')
                            ->label('Jumlah RW (Rukun Warga)')
                            ->numeric()
                            ->required(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ─── SECTION 2: Data Bangunan & Fasilitas (existing) ─────────────
                Section::make('🏘️ Data Bangunan & Fasilitas Desa')
                    ->description('Jumlah bangunan tempat tinggal, fasilitas umum, dan tempat ibadah.')
                    ->schema([
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
                    ->columns(3)
                    ->columnSpanFull(),

                // ─── SECTION 3: Data Per Dusun ────────────────────────────────────
                Section::make('🗺️ Persebaran Penduduk per Dusun / Lingkungan')
                    ->description('Masukkan nama setiap dusun dan jumlah jiwa yang bermukim di dusun tersebut.')
                    ->schema([
                        Repeater::make('hamlets_data')
                            ->label('')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Nama Dusun / Lingkungan')
                                    ->placeholder('mis. Dusun Kalisoko Kidul')
                                    ->required(),
                                TextInput::make('count')
                                    ->label('Jumlah Penduduk (Jiwa)')
                                    ->numeric()
                                    ->placeholder('mis. 1250')
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Dusun')
                            ->reorderable()
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ─── SECTION 4: Distribusi Agama ─────────────────────────────────
                Section::make('🕌 Distribusi Kepercayaan / Agama yang Dianut')
                    ->description('Jumlah penduduk berdasarkan agama yang dianut.')
                    ->schema([
                        Repeater::make('religion_data')
                            ->label('')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Nama Agama')
                                    ->placeholder('mis. Islam')
                                    ->required(),
                                TextInput::make('count')
                                    ->label('Jumlah Penganut (Jiwa)')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Agama')
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ─── SECTION 5: Jenjang Pendidikan ───────────────────────────────
                Section::make('🎓 Jenjang Pendidikan Masyarakat')
                    ->description('Distribusi penduduk berdasarkan jenjang pendidikan terakhir yang ditamatkan.')
                    ->schema([
                        Repeater::make('education_data')
                            ->label('')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Jenjang Pendidikan')
                                    ->placeholder('mis. Tamat SD/Sederajat')
                                    ->required(),
                                TextInput::make('count')
                                    ->label('Jumlah (Jiwa)')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Jenjang Pendidikan')
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ─── SECTION 6: Kelompok Usia ─────────────────────────────────────
                Section::make('👶 Distribusi Kelompok Usia Penduduk')
                    ->description('Jumlah penduduk per kelompok usia.')
                    ->schema([
                        Repeater::make('age_group_data')
                            ->label('')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Kelompok Usia')
                                    ->placeholder('mis. 0 – 14 Tahun (Anak-anak)')
                                    ->required(),
                                TextInput::make('count')
                                    ->label('Jumlah (Jiwa)')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Kelompok Usia')
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ─── SECTION 7: Mata Pencaharian ──────────────────────────────────
                Section::make('💼 Mata Pencaharian / Pekerjaan Utama Warga')
                    ->description('Distribusi penduduk berdasarkan mata pencaharian / sektor pekerjaan utama.')
                    ->schema([
                        Repeater::make('occupation_data')
                            ->label('')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Jenis Pekerjaan')
                                    ->placeholder('mis. Petani / Buruh Tani')
                                    ->required(),
                                TextInput::make('count')
                                    ->label('Jumlah (Jiwa)')
                                    ->numeric()
                                    ->required(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Jenis Pekerjaan')
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ─── SECTION 8: Keterangan Sumber Data ───────────────────────────
                Section::make('📋 Keterangan Sumber & Tanggal Data')
                    ->description('Informasi sumber data untuk ditampilkan pada halaman kependudukan publik.')
                    ->schema([
                        TextInput::make('last_updated_note')
                            ->label('Catatan Sumber Data')
                            ->placeholder('mis. Sumber: Buku Induk Penduduk Desa Tegalrejo, Data per Bulan Juli 2025')
                            ->helperText('Teks ini akan ditampilkan di bagian bawah halaman Kependudukan sebagai keterangan sumber resmi.')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}
