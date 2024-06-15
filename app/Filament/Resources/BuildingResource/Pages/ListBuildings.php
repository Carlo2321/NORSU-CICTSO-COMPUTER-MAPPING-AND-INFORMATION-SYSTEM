<?php

namespace App\Filament\Resources\BuildingResource\Pages;

use Filament\Actions;
use App\Models\Building;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\BuildingResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListBuildings extends ListRecords
{
    protected static string $resource = BuildingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->Icon('heroicon-m-plus-circle')
            ->label('Building'),
        ];
    }
    public function getTabs(): array
    {
        return [
            'All' => Tab::make('All')
                ->badge($this->getAllRoomsCount()),

            'This week' => Tab::make('This week')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>', now()->subWeek()))
                ->badge($this->getRoomsAddedSince(now()->subWeek())),

            'This month' => Tab::make('This month')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>', now()->subMonth()))
                ->badge($this->getRoomsAddedSince(now()->subMonth())),

            'This year' => Tab::make('This year')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>', now()->subYear()))
                ->badge($this->getRoomsAddedSince(now()->subYear())),
        ];
    }

    protected function getAllRoomsCount(): int
    {
        return Building::count();
    }

    protected function getRoomsAddedSince($date): int
    {
        return Building::where('created_at', '>', $date)->count();
    }
}
