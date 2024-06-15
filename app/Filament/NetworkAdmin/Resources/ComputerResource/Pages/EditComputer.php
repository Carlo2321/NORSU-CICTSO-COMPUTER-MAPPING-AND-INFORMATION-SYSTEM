<?php

namespace App\Filament\NetworkAdmin\Resources\ComputerResource\Pages;

use App\Filament\NetworkAdmin\Resources\ComputerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComputer extends EditRecord
{
    protected static string $resource = ComputerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
