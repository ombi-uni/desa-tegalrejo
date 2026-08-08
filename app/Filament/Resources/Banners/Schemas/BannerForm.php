<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Banner')
                    ->required(),
                TextInput::make('subtitle')
                    ->label('Sub-judul / Deskripsi Banner'),
                TextInput::make('button_text')
                    ->label('Teks Tombol CTA')
                    ->default('Jelajahi Desa'),
                TextInput::make('button_link')
                    ->label('Link Tombol CTA')
                    ->default('#'),
                TextInput::make('order')
                    ->label('Urutan Tampil')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Status Tampil')
                    ->default(true),
                FileUpload::make('image')
                    ->label('Gambar Hero Banner')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('banner-images')
                    ->columnSpanFull(),
            ]);
    }
}
