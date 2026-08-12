<?php

namespace App\Filament\Resources\Statistics\Pages;

use App\Filament\Resources\Statistics\StatisticResource;
use App\Models\Statistic;
use Filament\Resources\Pages\ListRecords;

class ListStatistics extends ListRecords
{
    protected static string $resource = StatisticResource::class;

    public function mount(): void
    {
        // Singleton: always redirect to edit of the single record
        $record = Statistic::firstOrCreate([]);
        $this->redirect(StatisticResource::getUrl('edit', ['record' => $record->id]));
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
