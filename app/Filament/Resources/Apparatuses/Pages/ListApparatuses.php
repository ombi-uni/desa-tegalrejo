<?php

namespace App\Filament\Resources\Apparatuses\Pages;

use App\Filament\Resources\Apparatuses\ApparatusResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApparatuses extends ListRecords
{
    protected static string $resource = ApparatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->label('+ Aparatur'),
        ];
    }
}
