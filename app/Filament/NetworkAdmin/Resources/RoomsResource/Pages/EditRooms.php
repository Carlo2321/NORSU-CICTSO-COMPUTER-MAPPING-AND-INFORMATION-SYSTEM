<?php

namespace App\Filament\NetworkAdmin\Resources\RoomsResource\Pages;

use App\Filament\NetworkAdmin\Resources\RoomsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRooms extends EditRecord
{
    protected static string $resource = RoomsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
