<?php

namespace App\Filament\Resources\Apparatuses\Pages;

use App\Filament\Resources\Apparatuses\ApparatusResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApparatus extends EditRecord
{
    protected static string $resource = ApparatusResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
