<?php

namespace App\Filament\NetworkAdmin\Resources;

use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PermissionResource;

class CreatePermission extends CreateRecord
{
    protected static string $resource = PermissionResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string{
        return 'Permission added';
    }

    protected function getCreatedNotification(): ?Notification{
        return Notification::make()
            ->success()
            ->title('Permission added')
            ->body('Permission added successfully.');
    }
}
