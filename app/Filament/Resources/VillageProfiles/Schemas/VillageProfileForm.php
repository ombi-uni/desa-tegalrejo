<?php

namespace App\Filament\Resources\VillageProfiles\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VillageProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
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
                FileUpload::make('logo')
                    ->label('Upload Logo / Lambang Desa (Opsional)')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('village-logos')
                    ->helperText('Format .png, .jpg, atau .svg transparan.'),
                TextInput::make('logo_icon')
                    ->label('Icon FontAwesome Logo (Jika tidak ada file logo)')
                    ->default('fa-solid fa-tree-city'),
                TextInput::make('kades_name')
                    ->label('Nama Kepala Desa')
                    ->required(),
                FileUpload::make('kades_photo')
                    ->label('Foto Kepala Desa')
                    ->image()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('kades-photos'),
                TextInput::make('video_url')
                    ->label('Link / URL Video YouTube Profil Desa')
                    ->placeholder('Contoh: https://www.youtube.com/watch?v=... atau https://youtu.be/...')
                    ->helperText('Cukup tempel link YouTube biasa dari browser/HP. Sistem otomatis memprosesnya agar dapat diputar langsung di website tanpa perlu repot embed manual.')
                    ->columnSpanFull(),
                Textarea::make('visi')
                    ->label('Visi Desa')
                    ->rows(4)
                    ->columnSpanFull(),
                Textarea::make('misi')
                    ->label('Misi Desa')
                    ->rows(6)
                    ->columnSpanFull(),
                RichEditor::make('kades_welcome_text')
                    ->label('Teks Sambutan Kepala Desa')
                    ->columnSpanFull(),
            ]);
    }
}
