<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('1. Pengaturan Dasar Banner (Gambar & Urutan)')
                    ->description('Tentukan foto latar hero dan urutan giliran tampil pada rotasi slider beranda.')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Unggah Gambar Hero Banner')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('banner-images')
                            ->helperText('Disarankan foto landscape beresolusi tinggi (misal: 1920 x 800 px) pemandangan desa, balai desa, atau potensi desa.')
                            ->columnSpanFull(),
                        Grid::make(2)->schema([
                            TextInput::make('order')
                                ->label('Urutan Tampil Slider (1, 2, 3, dst)')
                                ->numeric()
                                ->default(1)
                                ->helperText('Urutan ke-1 akan tampil paling awal saat website dibuka, lalu disusul ke-2, ke-3, dst.'),
                            Toggle::make('is_active')
                                ->label('Status Banner Aktif (Tayang)')
                                ->default(true)
                                ->helperText('Aktifkan agar banner ini ikut berputar pada slider beranda.'),
                        ]),
                    ]),

                Section::make('2. Pengaturan Lanjutan (Teks Judul & Tombol-Tombol)')
                    ->description('Atur teks tulisan dan link tombol CTA yang muncul di atas gambar banner.')
                    ->collapsible()
                    ->schema([
                        TextInput::make('badge_text')
                            ->label('Label Tag / Badge Kecil (Atas)')
                            ->default('Portal Resmi Desa Tegalrejo')
                            ->placeholder('Contoh: Portal Resmi Desa Tegalrejo')
                            ->columnSpanFull(),
                        TextInput::make('title')
                            ->label('Judul Utama Banner')
                            ->default('Selamat Datang di Website Resmi Desa Tegalrejo')
                            ->required()
                            ->columnSpanFull(),
                        Textarea::make('subtitle')
                            ->label('Sub-Judul / Deskripsi Banner')
                            ->default('Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah. Pusat informasi publik, keterbukaan anggaran, dan katalog digital UMKM desa.')
                            ->rows(3)
                            ->columnSpanFull(),

                        Grid::make(2)->schema([
                            Section::make('Tombol 1 (Utama - Biru)')
                                ->compact()
                                ->schema([
                                    TextInput::make('button_text')
                                        ->label('Teks Tombol 1')
                                        ->default('Lihat Produk UMKM'),
                                    TextInput::make('button_link')
                                        ->label('Link / URL Tujuan Tombol 1')
                                        ->default('/belanja')
                                        ->placeholder('/belanja atau /profil'),
                                ]),
                            Section::make('Tombol 2 (Sekunder - Transparan)')
                                ->compact()
                                ->schema([
                                    TextInput::make('button_secondary_text')
                                        ->label('Teks Tombol 2')
                                        ->default('Profil & Perangkat Desa')
                                        ->helperText('Kosongkan jika hanya ingin menampilkan 1 tombol.'),
                                    TextInput::make('button_secondary_link')
                                        ->label('Link / URL Tujuan Tombol 2')
                                        ->default('/profil')
                                        ->placeholder('/profil atau /berita'),
                                ]),
                        ]),
                    ]),
            ]);
    }
}

