<?php

namespace App\Filament\Resources\RoomResource\Pages;

use App\Models\Room;
use Filament\Actions;
use App\Filament\Resources\RoomResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListRooms extends ListRecords
{
    protected static string $resource = RoomResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->Icon('heroicon-m-plus-circle')
            ->label('Room'),
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
        return Room::count();
    }

    protected function getRoomsAddedSince($date): int
    {
        return Room::where('created_at', '>', $date)->count();
    }
}
