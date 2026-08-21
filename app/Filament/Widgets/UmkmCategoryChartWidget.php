<?php

namespace App\Filament\Widgets;

use App\Models\Umkm;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class UmkmCategoryChartWidget extends ChartWidget
{
    protected ?string $heading = 'Sebaran UMKM Berdasarkan Kategori';

    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $query = Umkm::select('category', DB::raw('count(*) as count'));
        
        $user = auth()->user();
        if ($user && $user->isDusunAdmin()) {
            $query->where('dusun', $user->dusun);
        }
        
        $categories = $query->groupBy('category')->get();

        $labels = [];
        $data = [];
        
        foreach ($categories as $cat) {
            $labels[] = $cat->category ?? 'Lainnya';
            $data[] = $cat->count;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Total UMKM',
                    'data' => $data,
                    'backgroundColor' => [
                        '#10b981', // emerald-500
                        '#f59e0b', // amber-500
                        '#3b82f6', // blue-500
                        '#8b5cf6', // violet-500
                        '#ec4899', // pink-500
                    ],
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
