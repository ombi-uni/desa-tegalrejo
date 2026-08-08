<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
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
                FileUpload::make('image')
                    ->label('Foto / Gambar Hero Banner')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('banner-images')
                    ->helperText('Disarankan foto landscape beresolusi tinggi (contoh: 1920 x 800 px) pemandangan desa, balai desa, atau potensi UMKM.')
                    ->columnSpanFull(),

                TextInput::make('order')
                    ->label('Urutan Tampil Slider (1, 2, 3, dst)')
                    ->numeric()
                    ->default(1)
                    ->helperText('Angka 1 akan tampil pertama saat web dibuka, disusul angka 2, 3, dan seterusnya.'),

                Toggle::make('is_active')
                    ->label('Status Banner Aktif (Tayang di Beranda)')
                    ->default(true)
                    ->helperText('Aktifkan agar banner ini ikut berputar pada slider beranda.'),

                TextInput::make('badge_text')
                    ->label('Teks Tag / Badge Kecil (Atas)')
                    ->default('Portal Resmi Desa Tegalrejo')
                    ->placeholder('Contoh: Portal Resmi Desa Tegalrejo atau Pengumuman Khusus')
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

                TextInput::make('button_text')
                    ->label('Teks Tombol 1 (Utama - Biru)')
                    ->default('Lihat Produk UMKM')
                    ->placeholder('Contoh: Lihat Produk UMKM'),

                TextInput::make('button_link')
                    ->label('Link Tujuan Tombol 1')
                    ->default('/belanja')
                    ->placeholder('Contoh: /belanja atau /profil'),

                TextInput::make('button_secondary_text')
                    ->label('Teks Tombol 2 (Sekunder - Opsional)')
                    ->default('Profil & Perangkat Desa')
                    ->helperText('Kosongkan jika hanya ingin menampilkan 1 tombol.')
                    ->placeholder('Contoh: Profil & Perangkat Desa'),

                TextInput::make('button_secondary_link')
                    ->label('Link Tujuan Tombol 2')
                    ->default('/profil')
                    ->placeholder('Contoh: /profil atau /berita'),
            ]);
    }
}
