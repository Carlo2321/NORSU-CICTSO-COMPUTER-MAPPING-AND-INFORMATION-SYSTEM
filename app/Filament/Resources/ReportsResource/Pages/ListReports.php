<?php

namespace App\Filament\Resources\ReportsResource\Pages;

use Filament\Actions;
use Filament\Widgets\TableWidget;
use Filament\Pages\Actions\ButtonAction;
use App\Filament\Widgets\LatestComputers;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ReportsResource;
use App\Filament\Widgets\LatestAddedComputers;
use App\Filament\Widgets\RoomWithMostFaultyComputers;
use App\Filament\Widgets\RoomWithMostWorkingComputers;

use App\Filament\Widgets\RoomWithMostNotWorkingComputers;



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
