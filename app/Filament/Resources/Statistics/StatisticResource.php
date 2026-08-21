<?php

namespace App\Filament\Resources\Statistics;

use App\Filament\Resources\Statistics\Pages\EditStatistic;
use App\Filament\Resources\Statistics\Pages\ListStatistics;
use App\Filament\Resources\Statistics\Schemas\StatisticForm;
use App\Filament\Resources\Statistics\Tables\StatisticsTable;
use App\Models\Statistic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StatisticResource extends Resource
{
    protected static ?string $model = Statistic::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected static ?string $navigationLabel = 'Statistik Beranda';

    protected static ?string $pluralModelLabel = 'Statistik Beranda';

    protected static ?string $modelLabel = 'Statistik Beranda';

    protected static string|\UnitEnum|null $navigationGroup = 'Data Kependudukan';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return StatisticForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StatisticsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index'  => ListStatistics::route('/'),
            'create' => \App\Filament\Resources\Statistics\Pages\CreateStatistic::route('/create'),
            'edit'   => EditStatistic::route('/{record}/edit'),
        ];
    }

    // Only super_admin can access this resource
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isSuperAdmin();
    }
}
