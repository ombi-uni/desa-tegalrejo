<?php

namespace App\Filament\Resources\Banners\Pages;

use App\Filament\Resources\Banners\BannerResource;
use App\Models\VillageProfile;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\FileUpload;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListBanners extends ListRecords
{
    protected static string $resource = BannerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('page_header_banners')
                ->label('🖼️ Atur Banner Header Halaman')
                ->color('info')
                ->modalHeading('Pengaturan Banner Header Setiap Halaman')
                ->modalDescription('Unggah dan atur gambar latar belakang header (banner) untuk masing-masing halaman website agar tampil estetik.')
                ->modalSubmitActionLabel('Simpan Banner Halaman')
                ->modalWidth('4xl')
                ->form([
                    FileUpload::make('profile_banner_image')
                        ->label('Banner Header Halaman: Profil Desa')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('page-banners')
                        ->helperText('Gambar latar header halaman Profil Desa (Rekomendasi rasio 16:9).'),
                    FileUpload::make('news_banner_image')
                        ->label('Banner Header Halaman: Portal Berita')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('page-banners')
                        ->helperText('Gambar latar header halaman Portal Berita & Artikel.'),
                    FileUpload::make('umkm_banner_image')
                        ->label('Banner Header Halaman: Belanja UMKM')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('page-banners')
                        ->helperText('Gambar latar header halaman Katalog Belanja UMKM.'),
                    FileUpload::make('budget_banner_image')
                        ->label('Banner Header Halaman: Transparansi APBDES')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('page-banners')
                        ->helperText('Gambar latar header halaman Transparansi Anggaran APBDES.'),
                    FileUpload::make('kependudukan_banner_image')
                        ->label('Banner Header Halaman: Kependudukan')
                        ->image()
                        ->disk('public')
                        ->visibility('public')
                        ->directory('page-banners')
                        ->helperText('Gambar latar header halaman Kependudukan dan Statistik.'),
                    FileUpload::make('pendapatan_doc')
                        ->label('📄 Dokumen PDF: Laporan Pendapatan Desa')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('local')
                        ->directory('budget-docs')
                        ->helperText('Satu file PDF laporan resmi yang mencakup semua item Pendapatan Desa. Tampil sebagai tombol unduh di tabel Pendapatan.'),
                    FileUpload::make('belanja_doc')
                        ->label('📄 Dokumen PDF: Laporan Belanja Desa')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('local')
                        ->directory('budget-docs')
                        ->helperText('Satu file PDF laporan resmi yang mencakup semua item Belanja Desa. Tampil sebagai tombol unduh di tabel Belanja.'),
                    FileUpload::make('pembiayaan_doc')
                        ->label('📄 Dokumen PDF: Laporan Pembiayaan / SILPA Desa')
                        ->acceptedFileTypes(['application/pdf'])
                        ->disk('local')
                        ->directory('budget-docs')
                        ->helperText('Satu file PDF laporan resmi yang mencakup Pembiayaan Desa / SILPA.'),
                ])
                ->fillForm(function () {
                    $profile = VillageProfile::first();
                    return [
                        'profile_banner_image' => $profile?->profile_banner_image,
                        'news_banner_image' => $profile?->news_banner_image,
                        'umkm_banner_image' => $profile?->umkm_banner_image,
                        'budget_banner_image' => $profile?->budget_banner_image,
                        'kependudukan_banner_image' => $profile?->kependudukan_banner_image,
                        'pendapatan_doc'           => $profile?->pendapatan_doc,
                        'belanja_doc'              => $profile?->belanja_doc,
                        'pembiayaan_doc'           => $profile?->pembiayaan_doc,
                    ];
                })
                ->action(function (array $data) {
                    $profile = VillageProfile::firstOrCreate([]);
                    $profile->update([
                        'profile_banner_image' => $data['profile_banner_image'] ?? null,
                        'news_banner_image' => $data['news_banner_image'] ?? null,
                        'umkm_banner_image' => $data['umkm_banner_image'] ?? null,
                        'budget_banner_image' => $data['budget_banner_image'] ?? null,
                        'kependudukan_banner_image' => $data['kependudukan_banner_image'] ?? null,
                        'pendapatan_doc'           => $data['pendapatan_doc'] ?? null,
                        'belanja_doc'              => $data['belanja_doc'] ?? null,
                        'pembiayaan_doc'           => $data['pembiayaan_doc'] ?? null,
                    ]);

                    Notification::make()
                        ->title('Banner Header Halaman Berhasil Diperbarui!')
                        ->success()
                        ->send();
                }),

            CreateAction::make()
                ->label('New Hero Banner'),
        ];
    }
}

