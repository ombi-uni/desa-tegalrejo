<?php

namespace App\Filament\Resources\Kependudukans\Schemas;

use App\Helpers\OccupationStyleHelper;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class KependudukanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // ─── SECTION 1: Ringkasan Kependudukan Utama ──────────────────────
                Section::make('📊 Data Pokok Kependudukan')
                    ->description('Jumlah penduduk, kepala keluarga, serta pembagian RT dan RW di Desa Tegalrejo.')
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

                // ─── SECTION 2: Data Per Dusun ────────────────────────────────────
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

                // ─── SECTION 3: Distribusi Agama ─────────────────────────────────
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

                // ─── SECTION 4: Jenjang Pendidikan ───────────────────────────────
                Section::make('🎓 Jenjang Pendidikan Masyarakat')
                    ->description('Masukkan jumlah penduduk berdasarkan jenjang pendidikan terakhir yang ditamatkan. Biarkan 0 jika tidak ada data.')
                    ->schema([
                        TextInput::make('education_data.belum_sekolah')->label('Belum Sekolah')->numeric()->default(0),
                        TextInput::make('education_data.tk')->label('TK / RA Sederajat')->numeric()->default(0),
                        TextInput::make('education_data.sd')->label('SD Sederajat')->numeric()->default(0),
                        TextInput::make('education_data.smp')->label('SMP Sederajat')->numeric()->default(0),
                        TextInput::make('education_data.sma')->label('SMA Sederajat')->numeric()->default(0),
                        TextInput::make('education_data.diploma')->label('Diploma 1/2/3 Sederajat')->numeric()->default(0),
                        TextInput::make('education_data.s1')->label('Strata 1 Sederajat')->numeric()->default(0),
                        TextInput::make('education_data.s2')->label('Strata 2 Sederajat')->numeric()->default(0),
                        TextInput::make('education_data.s3')->label('Strata 3 Sederajat')->numeric()->default(0),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // ─── SECTION 5: Kelompok Usia ─────────────────────────────────────
                Section::make('👶 Distribusi Kelompok Usia Penduduk')
                    ->description('Masukkan jumlah penduduk per kategori usia. Biarkan 0 jika tidak ada data.')
                    ->schema([
                        TextInput::make('age_group_data.balita')->label('Balita (0 - 5 Tahun)')->numeric()->default(0),
                        TextInput::make('age_group_data.anak')->label('Anak-Anak (6 - 12 Tahun)')->numeric()->default(0),
                        TextInput::make('age_group_data.remaja')->label('Remaja (13 - 17 Tahun)')->numeric()->default(0),
                        TextInput::make('age_group_data.dewasa')->label('Dewasa (18 - 59 Tahun)')->numeric()->default(0),
                        TextInput::make('age_group_data.lansia')->label('Lansia (60+ Tahun)')->numeric()->default(0),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // ─── SECTION 6: Mata Pencaharian ──────────────────────────────────
                Section::make('💼 Mata Pencaharian / Pekerjaan Utama Warga')
                    ->description('Distribusi penduduk berdasarkan mata pencaharian / sektor pekerjaan utama.')
                    ->schema([
                        Repeater::make('occupation_data')
                            ->label('')
                            ->schema([
                                TextInput::make('label')
                                    ->label('Jenis Pekerjaan')
                                    ->placeholder('mis. Petani / Buruh Tani')
                                    ->live(debounce: 400)
                                    ->required(),
                                TextInput::make('count')
                                    ->label('Jumlah (Jiwa)')
                                    ->numeric()
                                    ->required(),
                                Placeholder::make('icon_preview')
                                    ->label('🤖 Preview Icon (otomatis)')
                                    ->content(function ($get) {
                                        $label = $get('label');
                                        if (empty(trim($label ?? ''))) {
                                            return new HtmlString('<span class="text-xs text-slate-400 italic">Ketik nama pekerjaan untuk melihat preview icon…</span>');
                                        }
                                        $style = OccupationStyleHelper::getStyle($label);
                                        $icon  = $style['icon'];
                                        $bg    = $style['bg'];
                                        $tc    = $style['tc'];
                                        return new HtmlString(
                                            '<div class="flex items-center gap-3">'
                                            . '<span class="inline-flex items-center justify-center w-10 h-10 rounded-xl ' . $bg . ' ' . $tc . ' text-lg">'
                                            . '<i class="fa-solid ' . $icon . '"></i>'
                                            . '</span>'
                                            . '<span class="text-xs text-slate-500">Icon <code class="bg-slate-100 px-1 py-0.5 rounded font-mono">' . $icon . '</code> akan tampil di halaman Kependudukan</span>'
                                            . '</div>'
                                        );
                                    })
                                    ->columnSpanFull(),
                            ])
                            ->columns(2)
                            ->defaultItems(0)
                            ->addActionLabel('+ Tambah Jenis Pekerjaan')
                            ->collapsible()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // ─── SECTION 7: Catatan Sumber Data ───────────────────────────────
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
