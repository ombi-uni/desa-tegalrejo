<?php

namespace App\Filament\Resources\NavItems\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class NavItemsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order')->label('Urutan')->sortable(),
                TextColumn::make('title')->label('Nama Menu')->searchable()->sortable(),
                TextColumn::make('parent.title')->label('Induk (Dropdown)')->badge()->color('gray')->default('-'),
                TextColumn::make('url')->label('Tautan URL')->searchable(),
                TextColumn::make('target')->label('Target')->badge(),
                IconColumn::make('is_active')->label('Aktif')->boolean(),
            ])
            ->defaultSort('order', 'asc')
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
