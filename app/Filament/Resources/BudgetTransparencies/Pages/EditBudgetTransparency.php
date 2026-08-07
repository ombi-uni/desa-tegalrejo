<?php

namespace App\Filament\Resources\BudgetTransparencies\Pages;

use App\Filament\Resources\BudgetTransparencies\BudgetTransparencyResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditBudgetTransparency extends EditRecord
{
    protected static string $resource = BudgetTransparencyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
