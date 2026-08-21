<?php

namespace App\Filament\Resources\VillageProfiles;

use App\Filament\Resources\VillageProfiles\Pages\CreateVillageProfile;
use App\Filament\Resources\VillageProfiles\Pages\EditVillageProfile;
use App\Filament\Resources\VillageProfiles\Pages\ListVillageProfiles;
use App\Filament\Resources\VillageProfiles\Schemas\VillageProfileForm;
use App\Filament\Resources\VillageProfiles\Tables\VillageProfilesTable;
use App\Models\VillageProfile;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class VillageProfileResource extends Resource
{
    protected static ?string $model = VillageProfile::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInformationCircle;

    protected static ?string $navigationLabel = 'Profil & Visi Misi';

    protected static ?string $pluralModelLabel = 'Profil & Visi Misi';

    protected static string|\UnitEnum|null $navigationGroup = 'PENGATURAN';

    public static function getUrl(?string $name = null, array $parameters = [], bool $isAbsolute = true, ?string $panel = null, ?\Illuminate\Database\Eloquent\Model $tenant = null, bool $shouldGuessMissingParameters = false, ?string $configuration = null): string
    {
        if ($name === 'index' || $name === null) {
            $record = VillageProfile::firstOrCreate([]);
            return static::getUrl('edit', ['record' => $record->id], $isAbsolute, $panel, $tenant, $shouldGuessMissingParameters, $configuration);
        }
        return parent::getUrl($name, $parameters, $isAbsolute, $panel, $tenant, $shouldGuessMissingParameters, $configuration);
    }

    public static function form(Schema $schema): Schema
    {
        return VillageProfileForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([]);
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
            'index' => EditVillageProfile::route('/edit'),
            'edit' => EditVillageProfile::route('/{record}/edit'),
        ];
    }

    // Only super_admin can access this resource
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isSuperAdmin();
    }
}
