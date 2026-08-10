<?php

namespace App\Filament\Resources\Umkms\Schemas;

use App\Models\Umkm;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class UmkmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // 1. Identitas Usaha & Pemilik
                Section::make('Identitas Usaha & Pemilik')
                    ->description('Informasi utama toko, nama pemilik, kategori, dan deskripsi usaha.')
                    ->schema([
                        TextInput::make('store_name')
                            ->label('Nama Usaha / Toko UMKM')
                            ->placeholder('mis. Omah Keripik Tegalrejo')
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                            ->required(),

                        TextInput::make('slug')
                            ->label('Slug URL (Otomatis)')
                            ->helperText('Digunakan untuk tautan halaman web detail UMKM.')
                            ->required(),

                        TextInput::make('owner_name')
                            ->label('Nama Pemilik Usaha')
                            ->placeholder('mis. Ibu Sri Wahyuni')
                            ->required(),

                        Select::make('category')
                            ->label('Kategori Usaha')
                            ->options([
                                'Kuliner' => 'Kuliner (Makanan & Minuman)',
                                'Kerajinan' => 'Kerajinan & Seni',
                                'Pertanian & Peternakan' => 'Pertanian & Peternakan',
                                'Jasa & Fashion' => 'Jasa & Fashion',
                            ])
                            ->default('Kuliner')
                            ->required(),

                        TextInput::make('product_name')
                            ->label('Nama Produk Unggulan')
                            ->placeholder('mis. Keripik Singkong Balado & Keripik Pisang')
                            ->required(),

                        TextInput::make('price_range')
                            ->label('Kisaran / Rentang Harga')
                            ->placeholder('mis. Rp 10.000 - Rp 35.000'),

                        Textarea::make('description')
                            ->label('Deskripsi Lengkap & Cerita Usaha')
                            ->placeholder('Ceritakan keunggulan produk, bahan baku lokal, proses pembuatan higienis, dll...')
                            ->rows(4)
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('address')
                            ->label('Alamat Lengkap Tempat Usaha')
                            ->placeholder('mis. Dusun Tegalrejo RT 02 / RW 01, Desa Tegalrejo, Kec. Tengaran')
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // 2. Foto Utama & Galeri Produk
                Section::make('Foto Utama & Galeri Dokumentasi Usaha')
                    ->description('Unggah foto sampul toko dan foto-foto produk untuk meyakinkan pembeli.')
                    ->schema([
                        FileUpload::make('image')
                            ->label('Foto Sampul Utama Toko / Usaha')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('umkm-images')
                            ->helperText('Disarankan foto berkualitas baik yang menampilkan produk utama atau tempat usaha.')
                            ->columnSpanFull(),

                        FileUpload::make('gallery_images')
                            ->label('Galeri Foto Produk & Produksi (Bisa Pilih Banyak Foto)')
                            ->multiple()
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('umkm-gallery')
                            ->maxFiles(8)
                            ->reorderable()
                            ->helperText('Foto-foto ini akan tampil di galeri halaman detail toko untuk menambah kepercayaan pembeli.')
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // 3. Daftar Katalog Produk yang Dijual & Harganya
                Section::make('Daftar Produk & Harga (Katalog Menu)')
                    ->description('Rincian setiap produk atau varian yang dijual beserta harganya.')
                    ->schema([
                        Repeater::make('products_list')
                            ->label('Daftar Varian Produk')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Produk / Varian')
                                    ->placeholder('mis. Keripik Singkong Original 250g')
                                    ->required(),

                                TextInput::make('price')
                                    ->label('Harga Produk')
                                    ->placeholder('mis. Rp 15.000')
                                    ->required(),

                                TextInput::make('unit')
                                    ->label('Satuan / Kemasan')
                                    ->placeholder('mis. Bungkus / Pcs / Box / Toples'),

                                TextInput::make('description')
                                    ->label('Keterangan Singkat (Opsional)')
                                    ->placeholder('mis. Gurih bumbu bawang alami'),
                            ])
                            ->columns(2)
                            ->defaultItems(1)
                            ->addActionLabel('+ Tambah Produk / Varian Baru')
                            ->collapsible()
                            ->cloneable()
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull(),

                // 4. Kontak Pemesanan & Link Online
                Section::make('Kontak Pemesanan & Toko Online')
                    ->description('Saluran pemesanan langsung WhatsApp, Shopee, Tokopedia, dan Google Maps.')
                    ->schema([
                        TextInput::make('whatsapp_number')
                            ->label('Nomor WhatsApp Penjual')
                            ->placeholder('Contoh: 6281234567890')
                            ->helperText('Gunakan awalan 62 atau 08 (pembeli akan otomatis diarahkan ke chat WA).')
                            ->required(),

                        TextInput::make('google_maps_url')
                            ->label('Link Lokasi Google Maps')
                            ->placeholder('https://maps.app.goo.gl/... atau https://maps.google.com/...')
                            ->helperText('Frame peta lokasi usaha akan otomatis ditampilkan di halaman detail.'),

                        TextInput::make('shopee_url')
                            ->label('Link Toko Shopee (Opsional)')
                            ->placeholder('https://shopee.co.id/...'),

                        TextInput::make('tokopedia_url')
                            ->label('Link Toko Tokopedia (Opsional)')
                            ->placeholder('https://tokopedia.com/...'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),

                // 5. Legalitas & Sertifikasi
                Section::make('Legalitas & Sertifikasi Usaha')
                    ->description('Kelengkapan izin legalitas hasil pendampingan desa.')
                    ->schema([
                        Toggle::make('has_nib')
                            ->label('Memiliki NIB (Nomor Induk Berusaha)')
                            ->helperText('Centang jika usaha telah berbadan izin NIB resmi.'),

                        Toggle::make('has_pirt')
                            ->label('Memiliki Izin Edar PIRT')
                            ->helperText('Centang jika produk olahan pangan telah memiliki nomor PIRT.'),

                        Toggle::make('has_halal')
                            ->label('Memiliki Sertifikat Halal')
                            ->helperText('Centang jika produk telah tersertifikasi Halal MUI/Kemenag.'),
                    ])
                    ->columns(3)
                    ->columnSpanFull(),

                // 6. Pengaturan Tampilan di Beranda
                Section::make('Pengaturan Tampilan Unggulan di Beranda')
                    ->description('Beranda website menampilkan maksimal 4 UMKM unggulan pilihan.')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Tampilkan UMKM Ini di Halaman Beranda (Maksimal 4 Slot)')
                            ->live()
                            ->helperText(function ($record) {
                                $otherCount = Umkm::where('is_featured', true)
                                    ->when($record?->id, fn ($q) => $q->where('id', '!=', $record->id))
                                    ->count();
                                return "📊 Status: Saat ini ada {$otherCount} UMKM lain yang aktif di Beranda (Maksimal 4 UMKM).";
                            }),

                        Select::make('featured_order')
                            ->label('Urutan Slot di Beranda (1 - 4)')
                            ->options([
                                1 => 'Slot 1 (Paling Kiri)',
                                2 => 'Slot 2 (Tengah Kiri)',
                                3 => 'Slot 3 (Tengah Kanan)',
                                4 => 'Slot 4 (Paling Kanan)',
                            ])
                            ->visible(fn ($get) => (bool) $get('is_featured'))
                            ->default(1)
                            ->helperText('Atur urutan penempatan posisi kartu UMKM ini di beranda.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}

