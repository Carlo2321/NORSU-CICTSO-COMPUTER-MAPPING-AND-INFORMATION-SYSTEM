<?php

namespace App\Filament\NetworkAdmin\Resources\UserResource\Pages;

use App\Filament\NetworkAdmin\Resources\UserResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;


class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->Icon('heroicon-m-plus-circle')
            ->label('User'),
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

    protected function getRoomsAddedSince($date): int
    {
        return User::where('created_at', '>', $date)->count();
    }
    protected function getAllRoomsCount(): int
    {
        return User::count();
    }
}
