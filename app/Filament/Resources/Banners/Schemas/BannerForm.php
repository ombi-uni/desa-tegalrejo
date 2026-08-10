<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Section Atas: Lebar Penuh
                Section::make('Foto Hero & Pengaturan Slider')
                    ->description('Unggah foto utama dan atur urutan kemunculan banner pada slider beranda.')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto / Gambar Hero Banner')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('banner-images')
                            ->helperText('Disarankan foto landscape beresolusi tinggi (contoh: 1920 x 800 px) pemandangan desa, balai desa, atau potensi UMKM.')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('order')
                            ->label('Urutan Tampil Slider (1, 2, 3, dst)')
                            ->numeric()
                            ->default(1)
                            ->helperText('Angka 1 akan tampil pertama saat web dibuka, disusul angka 2, 3, dan seterusnya.')
                            ->required(),

                        Toggle::make('is_active')
                            ->label('Status Banner Aktif (Tayang di Beranda)')
                            ->default(true)
                            ->helperText('Aktifkan agar banner ini ikut berputar pada slider beranda.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // 2. Section Bawah: Sejajar Berdampingan (2 Kolom)
                Grid::make(['default' => 1, 'lg' => 2])
                    ->schema([
                        // Kolom Kiri: Teks Banner
                        Section::make('Teks Banner')
                            ->description('Pilihan untuk menyertakan judul dan sub-judul di atas gambar.')
                            ->schema([
                                Toggle::make('has_text')
                                    ->label('Gunakan Teks Banner')
                                    ->helperText('Nyalakan jika ingin menampilkan judul dan deskripsi teks.')
                                    ->live()
                                    ->default(fn ($record) => filled($record?->title) || filled($record?->subtitle))
                                    ->dehydrated(false)
                                    ->afterStateHydrated(fn ($component, $record) => $component->state(filled($record?->title) || filled($record?->subtitle)))
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if (!$state) {
                                            $set('title', null);
                                            $set('subtitle', null);
                                        }
                                    })
                                    ->columnSpanFull(),

                                TextInput::make('title')
                                    ->label('Judul Utama Banner')
                                    ->placeholder('Contoh: Selamat Datang di Website Resmi Desa Tegalrejo')
                                    ->visible(fn ($get) => (bool) $get('has_text'))
                                    ->columnSpanFull(),

                                Textarea::make('subtitle')
                                    ->label('Sub-Judul / Deskripsi Banner')
                                    ->placeholder('Contoh: Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah...')
                                    ->visible(fn ($get) => (bool) $get('has_text'))
                                    ->rows(4)
                                    ->columnSpanFull(),
                            ]),

                        // Kolom Kanan: Tombol Aksi
                        Section::make('Tombol Aksi')
                            ->description('Pilihan untuk menyertakan tombol navigasi/tautan pada banner.')
                            ->schema([
                                Toggle::make('has_buttons')
                                    ->label('Gunakan Tombol Aksi')
                                    ->helperText('Nyalakan jika ingin menyertakan tombol klik pada banner.')
                                    ->live()
                                    ->default(fn ($record) => filled($record?->button_text) || filled($record?->button_secondary_text))
                                    ->dehydrated(false)
                                    ->afterStateHydrated(fn ($component, $record) => $component->state(filled($record?->button_text) || filled($record?->button_secondary_text)))
                                    ->afterStateUpdated(function ($state, callable $set) {
                                        if (!$state) {
                                            $set('button_text', null);
                                            $set('button_link', null);
                                            $set('button_secondary_text', null);
                                            $set('button_secondary_link', null);
                                        }
                                    })
                                    ->columnSpanFull(),

                                TextInput::make('button_text')
                                    ->label('Teks Tombol 1 (Utama)')
                                    ->placeholder('Contoh: Lihat Produk UMKM')
                                    ->visible(fn ($get) => (bool) $get('has_buttons')),

                                TextInput::make('button_link')
                                    ->label('Link Tujuan Tombol 1')
                                    ->placeholder('Contoh: /umkm atau /profil')
                                    ->visible(fn ($get) => (bool) $get('has_buttons')),

                                TextInput::make('button_secondary_text')
                                    ->label('Teks Tombol 2 (Sekunder)')
                                    ->helperText('Kosongkan jika hanya ingin 1 tombol.')
                                    ->placeholder('Contoh: Profil & Perangkat Desa')
                                    ->visible(fn ($get) => (bool) $get('has_buttons')),

                                TextInput::make('button_secondary_link')
                                    ->label('Link Tujuan Tombol 2')
                                    ->placeholder('Contoh: /profil atau /berita')
                                    ->visible(fn ($get) => (bool) $get('has_buttons')),
                            ])
                            ->columns(2),
                    ])
                    ->columnSpanFull(),
            ]);
    }
}


