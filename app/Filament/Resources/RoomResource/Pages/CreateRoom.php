<?php

namespace App\Filament\Resources\RoomResource\Pages;

use Filament\Actions;
use App\Filament\Resources\RoomResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateRoom extends CreateRecord
{
    protected static string $resource = RoomResource::class;
    protected function getCreatedNotificationTitle(): ?string{
        return 'Room added';
    }

    protected function getCreatedNotification(): ?Notification{
        return Notification::make()
            ->success()
            ->title('Room added')
            ->body('Room added successfully.');
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
