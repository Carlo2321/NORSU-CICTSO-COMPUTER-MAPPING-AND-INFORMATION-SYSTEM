<?php

namespace App\Filament\NetworkAdmin\Resources\ComputerResource\Pages;

use App\Filament\NetworkAdmin\Resources\ComputerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewComputer extends ViewRecord
{
    protected static string $resource = ComputerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
