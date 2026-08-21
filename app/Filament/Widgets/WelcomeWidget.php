<?php

namespace App\Filament\Widgets;

use App\Models\Banner;
use App\Models\News;
use App\Models\Statistic;
use App\Models\Umkm;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class WelcomeWidget extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        $user = auth()->user();
        
        if ($user && $user->isDusunAdmin()) {
            $newsCount = News::where('dusun', $user->dusun)->count();
            $umkmCount = Umkm::where('dusun', $user->dusun)->count();
            
            return [
                Stat::make('Total Berita', $newsCount)
                    ->description('Berita & Kegiatan di dusun')
                    ->descriptionIcon('heroicon-m-newspaper')
                    ->color('success'),
                Stat::make('UMKM Desa', $umkmCount)
                    ->description('Terdaftar di sistem')
                    ->descriptionIcon('heroicon-m-building-storefront')
                    ->color('primary'),
            ];
        } else {
            $newsCount = News::count();
            $umkmCount = Umkm::count();
            $bannerCount = Banner::count();
            $populationCount = Statistic::first()?->population_count ?? 0;
            
            return [
                Stat::make('Total Berita', $newsCount)
                    ->description('Berita & Kegiatan')
                    ->descriptionIcon('heroicon-m-newspaper')
                    ->color('success'),
                Stat::make('UMKM Desa', $umkmCount)
                    ->description('Terdaftar di sistem')
                    ->descriptionIcon('heroicon-m-building-storefront')
                    ->color('primary'),
                Stat::make('Banner / Media', $bannerCount)
                    ->description('Gambar Utama')
                    ->descriptionIcon('heroicon-m-photo')
                    ->color('warning'),
                Stat::make('Total Penduduk', number_format((float)$populationCount, 0, ',', '.'))
                    ->description('Jiwa Terdaftar')
                    ->descriptionIcon('heroicon-m-users')
                    ->color('danger'),
            ];
        }
    }
}
