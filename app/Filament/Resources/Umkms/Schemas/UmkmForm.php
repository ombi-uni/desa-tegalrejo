<?php

namespace App\Filament\Resources\Umkms\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UmkmForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('store_name')
                    ->label('Nama Usaha / Toko')
                    ->required(),
                TextInput::make('owner_name')
                    ->label('Nama Pemilik UMKM')
                    ->required(),
                TextInput::make('product_name')
                    ->label('Nama Produk Unggulan')
                    ->required(),
                Select::make('category')
                    ->label('Kategori Usaha')
                    ->options([
                        'Kuliner' => 'Kuliner',
                        'Kerajinan' => 'Kerajinan',
                        'Pertanian & Peternakan' => 'Pertanian & Peternakan',
                        'Jasa & Fashion' => 'Jasa & Fashion',
                    ])
                    ->default('Kuliner')
                    ->required(),
                Textarea::make('description')
                    ->label('Deskripsi Produk')
                    ->required()
                    ->rows(3)
                    ->columnSpanFull(),
                TextInput::make('price_range')
                    ->label('Rentang Harga')
                    ->placeholder('mis. Rp 10.000 - Rp 35.000'),
                TextInput::make('whatsapp_number')
                    ->label('Nomor WhatsApp Pemesanan')
                    ->placeholder('Contoh: 628123456789')
                    ->required(),
                TextInput::make('google_maps_url')
                    ->label('Link Google Maps Lokasi Jualan')
                    ->placeholder('https://maps.app.goo.gl/...')
                    ->columnSpanFull(),
                TextInput::make('shopee_url')
                    ->label('Link Toko Shopee (Opsional)')
                    ->placeholder('https://shopee.co.id/...'),
                TextInput::make('tokopedia_url')
                    ->label('Link Toko Tokopedia (Opsional)')
                    ->placeholder('https://tokopedia.com/...'),
                Toggle::make('has_nib')
                    ->label('Memiliki Nomor Induk Berusaha (NIB)'),
                Toggle::make('has_pirt')
                    ->label('Memiliki Pangan Industri Rumah Tangga (PIRT)'),
                Toggle::make('has_halal')
                    ->label('Memiliki Sertifikat Halal'),
                Toggle::make('is_featured')
                    ->label('Tampilkan di Halaman Utama')
                    ->default(true),
                FileUpload::make('image')
                    ->label('Foto Produk UMKM')
                    ->image()
                    ->directory('umkm-images')
                    ->columnSpanFull(),
            ]);
    }
}
