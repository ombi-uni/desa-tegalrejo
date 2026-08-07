<?php

namespace App\Filament\Resources\Apparatuses;

use App\Filament\Resources\Apparatuses\Pages\CreateApparatus;
use App\Filament\Resources\Apparatuses\Pages\EditApparatus;
use App\Filament\Resources\Apparatuses\Pages\ListApparatuses;
use App\Filament\Resources\Apparatuses\Schemas\ApparatusForm;
use App\Filament\Resources\Apparatuses\Tables\ApparatusesTable;
use App\Models\Apparatus;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ApparatusResource extends Resource
{
    protected static ?string $model = Apparatus::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ApparatusForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApparatusesTable::configure($table);
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
            'index' => ListApparatuses::route('/'),
            'create' => CreateApparatus::route('/create'),
            'edit' => EditApparatus::route('/{record}/edit'),
        ];
    }
}
