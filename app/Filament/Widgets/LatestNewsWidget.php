<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\News\NewsResource;
use App\Models\News;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestNewsWidget extends BaseWidget
{
    protected static ?int $sort = 5;
    
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(NewsResource::getEloquentQuery()->latest()->limit(5))
            ->heading('Berita & Pengumuman Terbaru')
            ->description('Menampilkan 5 berita terakhir yang dipublikasikan.')
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail')->label('Sampul')->disk('public'),
                Tables\Columns\TextColumn::make('title')->label('Judul Berita')
                    ->description(fn (News $record): string => str($record->content)->stripTags()->limit(50)),
                Tables\Columns\TextColumn::make('status')->label('Status')->badge()->color(fn (string $state): string => match ($state) {
                    'published' => 'success',
                    'draft' => 'warning',
                    default => 'gray',
                }),
                Tables\Columns\TextColumn::make('published_at')->label('Tanggal')->dateTime('d M Y'),
            ])
            ->actions([
                \Filament\Actions\Action::make('view')
                    ->label('Lihat')
                    ->url(fn (News $record): string => NewsResource::getUrl('edit', ['record' => $record]))
                    ->icon('heroicon-m-pencil-square'),
            ])
            ->paginated(false);
    }
}
