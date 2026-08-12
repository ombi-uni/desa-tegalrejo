<?php

namespace App\Filament\Resources\Kependudukans\Pages;

use App\Filament\Resources\Kependudukans\KependudukanResource;
use App\Models\Statistic;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditKependudukan extends EditRecord
{
    protected static string $resource = KependudukanResource::class;

    /**
     * Always load the single statistics record (singleton pattern).
     * Creates it if it doesn't exist yet.
     */
    public function mount(int|string $record): void
    {
        $record = Statistic::firstOrCreate([]);
        parent::mount($record->id);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view_page')
                ->label('Lihat Halaman Kependudukan')
                ->icon('heroicon-o-arrow-top-right-on-square')
                ->color('gray')
                ->url(route('kependudukan.index'))
                ->openUrlInNewTab(),
        ];
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('✅ Data Kependudukan berhasil disimpan!')
            ->body('Perubahan akan langsung tampil di halaman publik kependudukan.');
    }
}
