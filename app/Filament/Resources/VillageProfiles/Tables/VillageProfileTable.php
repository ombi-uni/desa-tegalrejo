<?php

namespace App\Filament\Resources\VillageProfiles\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VillageProfileTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('kades_photo')->label('Foto Kades'),
                TextColumn::make('kades_name')->label('Nama Kades'),
                TextColumn::make('video_url')->label('Video Profil'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ]);
    }
}
