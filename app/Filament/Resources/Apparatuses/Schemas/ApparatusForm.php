<?php

namespace App\Filament\Resources\Apparatuses\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ApparatusForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required(),
                TextInput::make('position')
                    ->label('Jabatan Perangkat Desa')
                    ->required(),
                TextInput::make('phone')
                    ->label('Nomor Telepon / WA'),
                TextInput::make('order_level')
                    ->label('Urutan Struktur')
                    ->numeric()
                    ->default(1),
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
                FileUpload::make('photo')
                    ->label('Foto Resmi Perangkat Desa')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('apparatus-photos')
                    ->columnSpanFull(),
            ]);
    }
}
