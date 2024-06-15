<?php

namespace App\Filament\NetworkAdmin\Resources\RoomsResource\Pages;

use Filament\Actions;
use App\Filament\Resources\RoomResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\NetworkAdmin\Resources\RoomsResource;

class CreateRooms extends CreateRecord
{
    protected static string $resource = RoomsResource::class;
    protected function getCreatedNotificationTitle(): ?string{
        return 'Room added';
    }

    protected function getCreatedNotification(): ?Notification{
        return Notification::make()
            ->success()
            ->title('Room added')
            ->body('Room added successfully.');
    }
}
