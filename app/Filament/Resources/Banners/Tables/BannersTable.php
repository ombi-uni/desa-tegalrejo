<?php

namespace App\Filament\Resources\Banners\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class BannersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('order', 'asc')
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto Hero')
                    ->disk('public')
                    ->square()
                    ->height(45)
                    ->width(75),
                TextColumn::make('order')
                    ->label('Urutan Slider')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => "Urutan {$state}")
                    ->sortable(),
                TextColumn::make('title')
                    ->label('Judul Banner')
                    ->searchable()
                    ->sortable()
                    ->description(fn ($record) => Str::limit($record->subtitle, 40)),
                TextColumn::make('buttons')
                    ->label('Tombol Aktif')
                    ->state(function ($record) {
                        $b1 = $record->button_text ? "1: {$record->button_text}" : null;
                        $b2 = $record->button_secondary_text ? "2: {$record->button_secondary_text}" : null;
                        return implode(' | ', array_filter([$b1, $b2])) ?: 'Tanpa Tombol';
                    })
                    ->badge()
                    ->color('gray'),
                IconColumn::make('is_active')
                    ->label('Tayang di Web')
                    ->boolean(),
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

