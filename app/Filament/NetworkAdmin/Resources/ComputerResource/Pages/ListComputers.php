<?php

namespace App\Filament\NetworkAdmin\Resources\ComputerResource\Pages;

use Filament\Actions;
use App\Models\Computer;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\NetworkAdmin\Resources\ComputerResource;



class ListComputers extends ListRecords
{
    protected static string $resource = ComputerResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make()
    //         ->Icon('heroicon-m-plus-circle')
    //         ->label('Computer'),
    //     ];
    // }
    public function getTabs(): array
    {
        return [
            'All' => Tab::make('All')
                ->badge($this->getAllComputersCount()),

            'This week' => Tab::make('This week')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>', now()->subWeek()))
                ->badge($this->getComputersAddedSince(now()->subWeek())),

            'This month' => Tab::make('This month')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>', now()->subMonth()))
                ->badge($this->getComputersAddedSince(now()->subMonth())),

            'This year' => Tab::make('This year')
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>', now()->subYear()))
                ->badge($this->getComputersAddedSince(now()->subYear())),
        ];
    }

    protected function getAllComputersCount(): int
    {
        return Computer::count();
    }

    protected function getComputersAddedSince($date): int
    {
        return Computer::where('created_at', '>', $date)->count();
    }

}
