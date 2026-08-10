<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                    ->columns(2),

                Section::make('Teks Banner (Opsional)')
                    ->description('Tambahkan judul dan deskripsi jika ingin menampilkan teks di atas gambar.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Utama Banner')
                            ->placeholder('Contoh: Selamat Datang di Website Resmi Desa Tegalrejo')
                            ->columnSpanFull(),

                        Textarea::make('subtitle')
                            ->label('Sub-Judul / Deskripsi Banner')
                            ->placeholder('Contoh: Kecamatan Tengaran, Kabupaten Semarang, Jawa Tengah...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Tombol Aksi (Opsional)')
                    ->description('Tambahkan tombol navigasi pada banner jika diinginkan. Kosongkan jika tidak membutuhkan tombol.')
                    ->schema([
                        TextInput::make('button_text')
                            ->label('Teks Tombol 1 (Utama - Biru)')
                            ->placeholder('Contoh: Lihat Produk UMKM'),

                        TextInput::make('button_link')
                            ->label('Link Tujuan Tombol 1')
                            ->placeholder('Contoh: /umkm atau /profil'),

                        TextInput::make('button_secondary_text')
                            ->label('Teks Tombol 2 (Sekunder - Garis Putih)')
                            ->helperText('Kosongkan jika hanya ingin menampilkan 1 tombol.')
                            ->placeholder('Contoh: Profil & Perangkat Desa'),

                        TextInput::make('button_secondary_link')
                            ->label('Link Tujuan Tombol 2')
                            ->placeholder('Contoh: /profil atau /berita'),
                    ])
                    ->columns(2),
            ]);
    }
}

