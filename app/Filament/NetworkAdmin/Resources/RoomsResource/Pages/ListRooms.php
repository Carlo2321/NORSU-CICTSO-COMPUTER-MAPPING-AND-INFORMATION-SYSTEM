<?php

namespace App\Filament\NetworkAdmin\Resources\RoomsResource\Pages;

use App\Models\Room;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\NetworkAdmin\Resources\RoomsResource;

class ListRooms extends ListRecords
{
    protected static string $resource = RoomsResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make()
    //         ->Icon('heroicon-m-plus-circle')
    //         ->label('Room'),
    //     ];
    // }
    public function getTabs(): array {
        return [
            'All' => Tab::make('All'),
            'This week' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('roomName', '>', now()->subWeek()))
            ->badge(Room::query()->where('roomName', '>', now()->subWeek())->count()),
            'This month' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('roomName', '>', now()->subMonth()))
            ->badge(Room::query()->where('roomName', '>', now()->subMonth())->count()),
            'This year' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('roomName', '>', now()->subYear()))
            ->badge(Room::query()->where('roomName', '>', now()->subYear())->count()),
        ];
    }
}
