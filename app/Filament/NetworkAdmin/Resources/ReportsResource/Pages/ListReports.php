<?php

namespace App\Filament\NetworkAdmin\Resources\ReportsResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Widgets\LatestAddedComputers;
use App\Filament\Widgets\RoomWithMostFaultyComputers;
use App\Filament\Widgets\RoomWithMostWorkingComputers;
use App\Filament\NetworkAdmin\Resources\ReportsResource;

class ListReports extends ListRecords
{
    protected static string $resource = ReportsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
    protected function getHeaderWidgets(): array
    {
        return [
            LatestAddedComputers::class,
            RoomWithMostWorkingComputers::class,
            RoomWithMostFaultyComputers::class,
        ];
    }


}
