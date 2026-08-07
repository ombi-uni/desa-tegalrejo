<?php

namespace App\Filament\Resources\BudgetTransparencies\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class BudgetTransparencyForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('year')
                    ->label('Tahun Anggaran')
                    ->default('2026')
                    ->required(),
                Select::make('category')
                    ->label('Kategori Anggaran')
                    ->options([
                        'Pendapatan' => 'Pendapatan Desa',
                        'Belanja' => 'Belanja Desa',
                        'Pembiayaan' => 'Pembiayaan Desa',
                    ])
                    ->required(),
                TextInput::make('title')
                    ->label('Uraian / Rincian Pos Anggaran')
                    ->required(),
                TextInput::make('amount')
                    ->label('Jumlah (Nominal Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                FileUpload::make('pdf_file')
                    ->label('Dokumen Lampiran PDF Laporan Resmi')
                    ->directory('budget-pdfs')
                    ->acceptedFileTypes(['application/pdf'])
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->label('Catatan Keterangan Tambahan')
                    ->columnSpanFull(),
            ]);
    }
}
