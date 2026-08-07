<?php

namespace App\Filament\Resources\Umkms\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UmkmsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Foto'),
                TextColumn::make('store_name')->label('Nama Toko')->searchable()->sortable(),
                TextColumn::make('owner_name')->label('Pemilik')->searchable(),
                TextColumn::make('product_name')->label('Produk'),
                TextColumn::make('category')->label('Kategori')->badge(),
                TextColumn::make('price_range')->label('Harga'),
                IconColumn::make('has_nib')->label('NIB')->boolean(),
                IconColumn::make('has_pirt')->label('PIRT')->boolean(),
                IconColumn::make('has_halal')->label('Halal')->boolean(),
                IconColumn::make('is_featured')->label('Featured')->boolean(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
