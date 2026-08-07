<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Berita')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                TextInput::make('slug')
                    ->label('Slug URL')
                    ->required(),
                Select::make('category')
                    ->label('Kategori')
                    ->options([
                        'Kegiatan KKN' => 'Kegiatan KKN',
                        'Pengumuman' => 'Pengumuman',
                        'Pembangunan' => 'Pembangunan',
                        'Berita Utama' => 'Berita Utama',
                    ])
                    ->default('Kegiatan KKN')
                    ->required(),
                FileUpload::make('thumbnail')
                    ->label('Gambar Utama / Sampul')
                    ->image()
                    ->directory('news-thumbnails'),
                RichEditor::make('content')
                    ->label('Isi Berita Artikel')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('author')
                    ->label('Penulis')
                    ->default('Tim KKN / Admin Desa'),
                Select::make('status')
                    ->label('Status Publikasi')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Dipublikasikan',
                    ])
                    ->default('published'),
                DateTimePicker::make('published_at')
                    ->label('Tanggal Rilis')
                    ->default(now()),
            ]);
    }
}
