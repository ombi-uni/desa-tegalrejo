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
                ImageColumn::make('image')
                    ->label('Foto')
                    ->circular(false)
                    ->extraImgAttributes(['class' => 'rounded-xl object-cover']),

                TextColumn::make('store_name')
                    ->label('Nama Usaha / Toko')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('owner_name')
                    ->label('Pemilik')
                    ->searchable(),

                TextColumn::make('category')
                    ->label('Kategori')
                    ->badge()
                    ->colors([
                        'primary' => 'Kuliner',
                        'success' => 'Kerajinan',
                        'warning' => 'Pertanian & Peternakan',
                        'danger' => 'Jasa & Fashion',
                    ]),

                TextColumn::make('price_range_formatted')
                    ->label('Rentang Harga')
                    ->placeholder('-'),

                TextColumn::make('is_featured')
                    ->label('Status Beranda')
                    ->badge()
                    ->state(function ($record) {
                        if ($record->is_featured && $record->featured_order > 0) {
                            return '⭐ Beranda (Slot ' . $record->featured_order . ')';
                        }
                        return 'Katalog Saja';
                    })
                    ->colors([
                        'warning' => fn ($state) => str_contains($state, 'Beranda'),
                        'gray' => fn ($state) => $state === 'Katalog Saja',
                    ]),

                IconColumn::make('has_nib')->label('NIB')->boolean(),
                IconColumn::make('has_pirt')->label('PIRT')->boolean(),
                IconColumn::make('has_halal')->label('Halal')->boolean(),
                IconColumn::make('has_bpom')->label('BPOM')->boolean(),
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

