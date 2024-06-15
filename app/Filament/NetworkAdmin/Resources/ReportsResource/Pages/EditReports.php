<?php

namespace App\Filament\NetworkAdmin\Resources\ReportsResource\Pages;

use App\Filament\NetworkAdmin\Resources\ReportsResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReports extends EditRecord
{
    protected static string $resource = ReportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
