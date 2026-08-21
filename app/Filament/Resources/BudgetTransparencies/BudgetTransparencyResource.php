<?php

namespace App\Filament\Resources\BudgetTransparencies;

use App\Filament\Resources\BudgetTransparencies\Pages\CreateBudgetTransparency;
use App\Filament\Resources\BudgetTransparencies\Pages\EditBudgetTransparency;
use App\Filament\Resources\BudgetTransparencies\Pages\ListBudgetTransparencies;
use App\Filament\Resources\BudgetTransparencies\Schemas\BudgetTransparencyForm;
use App\Filament\Resources\BudgetTransparencies\Tables\BudgetTransparenciesTable;
use App\Models\BudgetTransparency;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class BudgetTransparencyResource extends Resource
{
    protected static ?string $model = BudgetTransparency::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBanknotes;

    protected static ?string $navigationLabel = 'Transparansi APBDES';

    protected static ?string $pluralModelLabel = 'Transparansi APBDES';

    protected static string|\UnitEnum|null $navigationGroup = 'DATA & STATISTIK';

    public static function form(Schema $schema): Schema
    {
        return BudgetTransparencyForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return BudgetTransparenciesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListBudgetTransparencies::route('/'),
            'create' => CreateBudgetTransparency::route('/create'),
            'edit' => EditBudgetTransparency::route('/{record}/edit'),
        ];
    }

    // Only super_admin can access this resource
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isSuperAdmin();
    }
}
