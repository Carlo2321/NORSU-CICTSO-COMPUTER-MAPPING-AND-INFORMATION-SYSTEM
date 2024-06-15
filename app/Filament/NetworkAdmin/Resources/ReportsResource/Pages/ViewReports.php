<?php

namespace App\Filament\NetworkAdmin\Resources\ReportsResource\Pages;

use App\Filament\NetworkAdmin\Resources\ReportsResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewReports extends ViewRecord
{
    protected static string $resource = ReportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
