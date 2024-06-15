<?php

namespace App\Filament\NetworkAdmin\Resources\ComputerResource\Pages;

use App\Filament\NetworkAdmin\Resources\ComputerResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateComputer extends CreateRecord
{
    protected static string $resource = ComputerResource::class;

    protected function getCreatedNotificationTitle(): ?string{
        return 'Computer added';
    }

    protected function getCreatedNotification(): ?Notification{
        return Notification::make()
            ->success()
            ->title('Computer added')
            ->body('Computer added successfully.');
    }
}
