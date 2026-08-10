<?php

namespace App\Filament\Resources\VillageProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class VillageProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Identitas Desa & Logo')
                    ->description('Atur nama wilayah dan lambang resmi desa untuk navbar dan footer.')
                    ->schema([
                        TextInput::make('village_name')
                            ->label('Nama Desa')
                            ->default('Desa Tegalrejo')
                            ->required(),
                        TextInput::make('subdistrict')
                            ->label('Kecamatan')
                            ->default('Kec. Tengaran')
                            ->required(),
                        TextInput::make('district')
                            ->label('Kabupaten')
                            ->default('Kab. Semarang')
                            ->required(),
                        TextInput::make('logo_icon')
                            ->label('Icon FontAwesome Logo (Fallback)')
                            ->default('fa-solid fa-tree-city'),
                        FileUpload::make('logo')
                            ->label('Upload Logo / Lambang Desa (Opsional)')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('village-logos')
                            ->helperText('Format .png, .jpg, atau .svg transparan.')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Video Profil Desa (Halaman Beranda)')
                    ->description('Atur video YouTube, judul, dan teks penjelasan pada section video profil di halaman beranda.')
                    ->schema([
                        TextInput::make('video_url')
                            ->label('Link / URL Video YouTube Profil Desa')
                            ->placeholder('Contoh: https://www.youtube.com/watch?v=... atau https://youtu.be/...')
                            ->helperText('Cukup tempel link YouTube biasa dari browser atau aplikasi YouTube di HP. Sistem otomatis memprosesnya agar dapat diputar langsung di website tanpa perlu embed manual.')
                            ->columnSpanFull(),
                        TextInput::make('video_title')
                            ->label('Judul Section Video Profil (Beranda)')
                            ->default('Video Profil Desa Tegalrejo')
                            ->placeholder('Video Profil Desa Tegalrejo')
                            ->columnSpanFull(),
                        Textarea::make('video_description')
                            ->label('Deskripsi / Teks Penjelasan Video (Beranda)')
                            ->placeholder('Saksikan keindahan alam, kehidupan masyarakat yang kental akan kebersamaan, serta geliat ekonomi UMKM lokal...')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                Section::make('Visi & Misi Desa')
                    ->description('Visi dan misi resmi Desa Tegalrejo yang tampil pada halaman Profil Desa.')
                    ->schema([
                        Textarea::make('visi')
                            ->label('Visi Desa')
                            ->rows(3)
                            ->columnSpanFull(),
                        Textarea::make('misi')
                            ->label('Misi Desa')
                            ->rows(6)
                            ->columnSpanFull(),
                    ]),

                Section::make('Kepala Desa & Kata Sambutan')
                    ->description('Informasi pimpinan desa beserta teks sambutan resmi pada halaman Profil.')
                    ->schema([
                        TextInput::make('kades_name')
                            ->label('Nama Kepala Desa')
                            ->required(),
                        FileUpload::make('kades_photo')
                            ->label('Foto Kepala Desa')
                            ->image()
                            ->disk('public')
                            ->visibility('public')
                            ->directory('kades-photos'),
                        RichEditor::make('kades_welcome_text')
                            ->label('Teks Sambutan Kepala Desa')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
