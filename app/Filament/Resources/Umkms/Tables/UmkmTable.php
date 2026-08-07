<?php

namespace App\Filament\Resources\Umkms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UmkmTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Foto Produk'),
                TextColumn::make('store_name')->label('Nama Toko')->searchable()->sortable(),
                TextColumn::make('owner_name')->label('Pemilik'),
                TextColumn::make('category')->label('Kategori')->badge(),
                IconColumn::make('has_nib')->label('NIB')->boolean(),
                IconColumn::make('has_pirt')->label('PIRT')->boolean(),
                IconColumn::make('has_halal')->label('Halal')->boolean(),
                TextColumn::make('whatsapp_number')->label('No WA'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
