<?php

namespace App\Filament\Resources\Umkms\Pages;

use App\Filament\Resources\Umkms\UmkmResource;
use App\Models\Umkm;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\Select;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ListRecords;

class ListUmkms extends ListRecords
{
    protected static string $resource = UmkmResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('manage_featured_umkms')
                ->label('⭐ Atur 4 UMKM Beranda')
                ->icon('heroicon-o-sparkles')
                ->color('warning')
                ->modalHeading('⭐ Atur & Tukar Posisi 4 UMKM di Beranda')
                ->modalDescription('Pilih UMKM untuk mengisi masing-masing slot posisi (Slot 1 sampai Slot 4) yang ditampilkan pada Halaman Beranda. Anda dapat menukar posisi toko dengan mudah di sini.')
                ->fillForm(function () {
                    $featured = Umkm::where('is_featured', true)->orderBy('featured_order')->orderBy('id')->get();
                    return [
                        'slot_1' => $featured->get(0)?->id,
                        'slot_2' => $featured->get(1)?->id,
                        'slot_3' => $featured->get(2)?->id,
                        'slot_4' => $featured->get(3)?->id,
                    ];
                })
                ->form([
                    Select::make('slot_1')
                        ->label('UMKM Slot 1 (Paling Kiri)')
                        ->options(fn () => Umkm::all()->pluck('store_name', 'id'))
                        ->searchable()
                        ->preload()
                        ->nullable(),
                    Select::make('slot_2')
                        ->label('UMKM Slot 2 (Tengah Kiri)')
                        ->options(fn () => Umkm::all()->pluck('store_name', 'id'))
                        ->searchable()
                        ->preload()
                        ->nullable(),
                    Select::make('slot_3')
                        ->label('UMKM Slot 3 (Tengah Kanan)')
                        ->options(fn () => Umkm::all()->pluck('store_name', 'id'))
                        ->searchable()
                        ->preload()
                        ->nullable(),
                    Select::make('slot_4')
                        ->label('UMKM Slot 4 (Paling Kanan)')
                        ->options(fn () => Umkm::all()->pluck('store_name', 'id'))
                        ->searchable()
                        ->preload()
                        ->nullable(),
                ])
                ->action(function (array $data) {
                    Umkm::query()->update(['is_featured' => false, 'featured_order' => 0]);

                    $slots = [
                        1 => $data['slot_1'] ?? null,
                        2 => $data['slot_2'] ?? null,
                        3 => $data['slot_3'] ?? null,
                        4 => $data['slot_4'] ?? null,
                    ];

                    foreach ($slots as $order => $umkmId) {
                        if (!empty($umkmId)) {
                            Umkm::where('id', $umkmId)->update([
                                'is_featured' => true,
                                'featured_order' => $order,
                            ]);
                        }
                    }

                    Notification::make()
                        ->title('Berhasil Mengatur 4 UMKM Beranda')
                        ->body('Urutan dan pilihan 4 UMKM di halaman beranda telah berhasil diperbarui.')
                        ->success()
                        ->send();
                }),

            CreateAction::make(),
        ];
    }
}

