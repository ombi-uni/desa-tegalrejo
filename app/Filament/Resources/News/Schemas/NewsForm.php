<?php

namespace App\Filament\Resources\News\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class NewsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Informasi Berita & Foto Sampul')
                    ->description('Atur judul, kategori, dan foto thumbnail utama berita.')
                    ->schema([
                        TextInput::make('title')
                            ->label('Judul Berita')
                            ->placeholder('Contoh: Kerja Bakti Warga Desa Tegalrejo...')
                            ->required()
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state)))
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->label('Slug URL (Otomatis)')
                            ->helperText('Dibuat otomatis dari judul berita untuk link website.')
                            ->required(),
                        Select::make('category')
                            ->label('Kategori Berita')
                            ->options([
                                'Kegiatan KKN' => 'Kegiatan KKN',
                                'Kemasyarakatan' => 'Kemasyarakatan (Kerja Bakti, Gotong Royong, dll)',
                                'BUMDES' => 'BUMDES (Badan Usaha Milik Desa)',
                                'Berita Utama' => 'Berita Utama',
                                'Kegiatan Desa' => 'Kegiatan Desa',
                                'Pembangunan' => 'Pembangunan',
                                'Pengumuman' => 'Pengumuman Resmi',
                            ])
                            ->default('Kegiatan KKN')
                            ->required(),
                        FileUpload::make('thumbnail')
                            ->label('Foto Sampul Utama (Header Berita)')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('news-thumbnails')
                            ->helperText('Foto sampul yang akan tampil di kartu berita beranda dan halaman artikel.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Isi Artikel Berita (Dengan Fitur Sisip Foto Dokumentasi)')
                    ->description('Tulis konten berita secara leluasa. Anda dapat menyisipkan foto dokumentasi kegiatan di tengah paragraf tulisan.')
                    ->schema([
                        RichEditor::make('content')
                            ->label('Isi Tulisan Berita')
                            ->placeholder('Mulai tulis isi berita di sini...')
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('news-content-images')
                            ->helperText('💡 TIPS: Untuk menyisipkan foto di tengah-tengah tulisan, klik tombol ikon lampiran / klip kertas pada bilah menu editor di atas.')
                            ->required()
                            ->columnSpanFull(),
                    ]),

                Section::make('Penulis & Jadwal Publikasi')
                    ->description('Atur nama kontributor penulis dan status tayang.')
                    ->schema([
                        TextInput::make('author')
                            ->label('Nama Penulis / Kontributor')
                            ->default('Admin Desa Tegalrejo')
                            ->required(),
                        Select::make('status')
                            ->label('Status Publikasi')
                            ->options([
                                'published' => 'Dipublikasikan (Tayang di Website)',
                                'draft' => 'Draft (Disimpan Sementara)',
                            ])
                            ->default('published')
                            ->required(),
                        DateTimePicker::make('published_at')
                            ->label('Tanggal & Waktu Rilis')
                            ->default(now())
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
