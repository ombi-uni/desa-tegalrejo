<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Umkms\UmkmResource;
use App\Models\Umkm;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestUmkmWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(UmkmResource::getEloquentQuery()->latest()->limit(5))
            ->heading('Data UMKM Kelurahan')
            ->description('Menampilkan 5 pendaftar UMKM terbaru.')
            ->columns([
                Tables\Columns\ImageColumn::make('image')->label('Foto')
                    ->disk('public')
                    ->circular(),
                Tables\Columns\TextColumn::make('store_name')->label('Nama Usaha'),
                Tables\Columns\TextColumn::make('category')->label('Kategori')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('owner_name')->label('Pemilik'),
                Tables\Columns\TextColumn::make('address')->label('Alamat')
                    ->limit(40),
                Tables\Columns\TextColumn::make('clean_whatsapp')->label('No. HP'),
            ])
            ->actions([
                \Filament\Actions\Action::make('view')
                    ->label('Lihat')
                    ->url(fn (Umkm $record): string => UmkmResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->paginated(false);
    }
}
