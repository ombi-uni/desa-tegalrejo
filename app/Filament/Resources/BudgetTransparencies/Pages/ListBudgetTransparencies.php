<?php

namespace App\Filament\Resources\BudgetTransparencies\Pages;

use App\Filament\Resources\BudgetTransparencies\BudgetTransparencyResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListBudgetTransparencies extends ListRecords
{
    protected static string $resource = BudgetTransparencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
