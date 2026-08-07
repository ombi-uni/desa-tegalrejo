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
                TextInput::make('kades_name')
                    ->label('Nama Kepala Desa')
                    ->required(),
                FileUpload::make('kades_photo')
                    ->label('Foto Kepala Desa')
                    ->image()
                    ->directory('kades-photos'),
                TextInput::make('video_url')
                    ->label('URL Video Profil Desa (YouTube Embed)')
                    ->placeholder('https://www.youtube.com/embed/...'),
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
