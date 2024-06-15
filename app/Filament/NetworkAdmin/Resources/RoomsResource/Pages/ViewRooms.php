<?php

namespace App\Filament\NetworkAdmin\Resources\RoomsResource\Pages;

use App\Filament\NetworkAdmin\Resources\RoomsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewRooms extends ViewRecord
{
    protected static string $resource = RoomsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
