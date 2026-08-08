<?php

namespace App\Filament\Resources\NavItems\Schemas;

use App\Models\NavItem;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NavItemForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Nama Menu / Opsi Halaman')
                    ->placeholder('Contoh: Layanan Surat Online')
                    ->required(),
                TextInput::make('url')
                    ->label('Tautan URL / Halaman')
                    ->placeholder('Contoh: /surat-online atau https://...')
                    ->required(),
                Select::make('parent_id')
                    ->label('Induk Menu (Pilih jika ingin dijadikan Dropdown Sub-Menu)')
                    ->options(fn () => NavItem::whereNull('parent_id')->pluck('title', 'id'))
                    ->placeholder('-- Menu Utama (Bukan Dropdown) --')
                    ->nullable(),
                TextInput::make('order')
                    ->label('Urutan Posisi di NavBar')
                    ->numeric()
                    ->default(1)
                    ->required(),
                Select::make('target')
                    ->label('Target Pembukaan Halaman')
                    ->options([
                        '_self' => 'Buka di Tab yang Sama (Default)',
                        '_blank' => 'Buka di Tab Baru (External / Dokumen)',
                    ])
                    ->default('_self')
                    ->required(),
                Toggle::make('is_active')
                    ->label('Status Aktif / Tampilkan di NavBar')
                    ->default(true),
                TextInput::make('badge')
                    ->label('Label Badge Opsional (Kosongkan jika tidak ada)')
                    ->placeholder('Contoh: Baru, Layanan, Info'),
            ]);
    }
}
