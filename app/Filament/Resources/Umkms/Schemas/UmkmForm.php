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

                        Select::make('dusun')
                            ->label('Dusun Lokasi UMKM')
                            ->options([
                                'Dusun Tegalrejo'       => 'Dusun Tegalrejo',
                                'Dusun Ngesrep'         => 'Dusun Ngesrep',
                                'Dusun Kalisoko Lor'    => 'Dusun Kalisoko Lor',
                                'Dusun Kalisoko Kidul'  => 'Dusun Kalisoko Kidul',
                                'Dusun Tlatar'          => 'Dusun Tlatar',
                                'Dusun Dosowarung'      => 'Dusun Dosowarung',
                            ])
                            ->default(fn () => auth()->user()->isDusunAdmin()
                                ? auth()->user()->dusun
                                : null
                            )
                            ->disabled(fn () => auth()->user()->isDusunAdmin())
                            ->dehydrated()
                            ->placeholder('Pilih dusun lokasi UMKM'),

                        TextInput::make('product_name')
                            ->label('Nama Produk Unggulan')
                            ->placeholder('mis. Keripik Singkong Balado & Keripik Pisang')
                            ->required()
                            ->columnSpanFull(),

                        TextInput::make('price_min')
                            ->label('Kisaran Harga: Termurah (Min)')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('mis. 10000')
                            ->helperText('Cukup masukkan angka saja tanpa titik / Rp.')
                            ->required(),

                        TextInput::make('price_max')
                            ->label('Kisaran Harga: Tertinggi (Max)')
                            ->numeric()
                            ->prefix('Rp')
                            ->placeholder('mis. 35000')
                            ->helperText('Cukup masukkan angka saja tanpa titik / Rp.')
                            ->required(),

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
                                    ->numeric()
                                    ->prefix('Rp')
                                    ->placeholder('15000')
                                    ->helperText('Masukkan angka tanpa titik / Rp.')
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
                            ->label('Nomor Induk Berusaha (NIB Resmi)')
                            ->helperText('Centang jika usaha telah memiliki izin NIB.'),

                        Toggle::make('has_pirt')
                            ->label('Izin Edar PIRT')
                            ->helperText('Centang jika olahan pangan memiliki PIRT.'),

                        Toggle::make('has_halal')
                            ->label('Sertifikat Halal (MUI / Kemenag)')
                            ->helperText('Centang jika tersertifikasi Halal.'),

                        Toggle::make('has_bpom')
                            ->label('Izin Edar BPOM')
                            ->helperText('Centang jika produk memiliki izin BPOM.'),
                    ])
                    ->columns(2)
                    ->columnSpanFull(),
            ]);
    }
}


