<?php

namespace App\Filament\Resources\BudgetTransparencies\Schemas;

use Filament\Forms\Components\Placeholder;
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
                        'Pendapatan'  => 'Pendapatan Desa',
                        'Belanja'     => 'Belanja Desa',
                        'Pembiayaan'  => 'Pembiayaan Desa (SILPA Tahun Lalu & Penerimaan Pembiayaan)',
                    ])
                    ->helperText('Kategori "Pembiayaan" digunakan untuk mencatat SILPA dari tahun anggaran sebelumnya dan penerimaan/pengeluaran pembiayaan lainnya.')
                    ->required(),
                TextInput::make('title')
                    ->label('Uraian / Rincian Pos Anggaran')
                    ->required(),
                TextInput::make('amount')
                    ->label('Jumlah (Nominal Rp)')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),
                Textarea::make('notes')
                    ->label('Catatan Keterangan Tambahan')
                    ->columnSpanFull(),
                Placeholder::make('doc_info')
                    ->label('')
                    ->content('💡 Untuk melampirkan dokumen PDF laporan, gunakan tombol "Atur Dokumen Laporan" di halaman daftar Transparansi APBDES.')
                    ->columnSpanFull(),
            ]);
    }
}
