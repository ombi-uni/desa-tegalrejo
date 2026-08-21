<?php

namespace App\Filament\Resources\Kependudukans;

use App\Filament\Resources\Kependudukans\Pages\EditKependudukan;
use App\Filament\Resources\Kependudukans\Schemas\KependudukanForm;
use App\Models\Statistic;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class KependudukanResource extends Resource
{
    protected static ?string $model = Statistic::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $navigationLabel = 'Data Kependudukan';

    protected static ?string $pluralModelLabel = 'Data Kependudukan';

    protected static ?string $modelLabel = 'Data Kependudukan';

    protected static string|\UnitEnum|null $navigationGroup = 'DATA & STATISTIK';

    protected static ?int $navigationSort = 1;

    /**
     * Always redirect to the edit page of the single record (singleton pattern).
     */
    public static function getUrl(?string $name = null, array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null, bool $shouldGuessMissingParameters = false, ?string $configuration = null): string
    {
        if ($name === 'index' || $name === null) {
            $record = Statistic::firstOrCreate([]);
            return static::getUrl('edit', ['record' => $record->id], $isAbsolute, $panel, $tenant, $shouldGuessMissingParameters, $configuration);
        }
        return parent::getUrl($name, $parameters, $isAbsolute, $panel, $tenant, $shouldGuessMissingParameters, $configuration);
    }

    public static function form(Schema $schema): Schema
    {
        return KependudukanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => EditKependudukan::route('/edit'),
            'edit'  => EditKependudukan::route('/{record}/edit'),
        ];
    }

    // Only super_admin can access this resource
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isSuperAdmin();
    }
}
