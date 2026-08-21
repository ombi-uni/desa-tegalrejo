<?php

namespace App\Filament\Widgets;

use App\Models\Statistic;
use Filament\Widgets\ChartWidget;

class DemographicsChartWidget extends ChartWidget
{
    protected ?string $heading = 'Statistik Demografi Penduduk';

    protected static ?int $sort = 3;

    protected function getFilters(): ?array
    {
        return [
            'education_data' => 'Pendidikan',
            'occupation_data' => 'Pekerjaan',
            'religion_data' => 'Agama',
            'age_group_data' => 'Kelompok Umur',
        ];
    }

    protected function getData(): array
    {
        $activeFilter = $this->filter ?? 'education_data';
        
        $stat = Statistic::first();
        $rawData = $stat ? ($stat->{$activeFilter} ?? []) : [];
        
        $labels = [];
        $data = [];
        
        foreach ($rawData as $item) {
            $labels[] = $item['label'] ?? 'Unknown';
            $data[] = $item['count'] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Jiwa',
                    'data' => $data,
                    'backgroundColor' => '#0284c7', // Tailwind sky-600
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    public static function canView(): bool
    {
        return auth()->check() && !auth()->user()->isDusunAdmin();
    }
}
