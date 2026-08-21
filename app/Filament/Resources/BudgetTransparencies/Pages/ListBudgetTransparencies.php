<?php

namespace App\Filament\Resources\BudgetTransparencies\Pages;

use App\Filament\Resources\BudgetTransparencies\BudgetTransparencyResource;
use App\Models\VillageProfile;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListBudgetTransparencies extends ListRecords
{
    protected static string $resource = BudgetTransparencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('atur_dokumen')
                ->label('Atur Dokumen Laporan')
                ->color('info')
                ->modalHeading('Atur Dokumen PDF Laporan APBDES')
                ->modalDescription('Unggah satu file PDF resmi per kategori anggaran. Dokumen akan tampil sebagai tombol "Unduh Laporan PDF" di header tabel pada halaman Transparansi.')
                ->modalWidth('lg')
                ->form([
                    FileUpload::make('pendapatan_doc')
                        ->label('Dokumen PDF: Laporan Pendapatan Desa')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('local')
                        ->directory('budget-docs')
                        ->helperText('Satu file PDF yang mencakup keseluruhan rincian Pendapatan Desa.'),
                    FileUpload::make('belanja_doc')
                        ->label('Dokumen PDF: Laporan Belanja Desa')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('local')
                        ->directory('budget-docs')
                        ->helperText('Satu file PDF yang mencakup keseluruhan rincian Belanja Desa.'),
                    FileUpload::make('pembiayaan_doc')
                        ->label('Dokumen PDF: Laporan Pembiayaan / SILPA Desa')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('local')
                        ->directory('budget-docs')
                        ->helperText('Satu file PDF yang mencakup Pembiayaan Desa / SILPA.'),
                ])
                ->action(function (array $data) {
                    $profile = VillageProfile::firstOrCreate([]);
                    $profile->update([
                        'pendapatan_doc'  => $data['pendapatan_doc']  ?? null,
                        'belanja_doc'     => $data['belanja_doc']     ?? null,
                        'pembiayaan_doc'  => $data['pembiayaan_doc']  ?? null,
                    ]);
                    Notification::make()
                        ->title('Dokumen Laporan APBDES Berhasil Diperbarui!')
                        ->success()
                        ->send();
                }),

            CreateAction::make()->label('+ Transparansi'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'Semua Data' => Tab::make(),
            'Pendapatan Desa' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('category', 'Pendapatan')),
            'Belanja Desa' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('category', 'Belanja')),
            'Pembiayaan Desa' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('category', 'Pembiayaan')),
        ];
    }
}
