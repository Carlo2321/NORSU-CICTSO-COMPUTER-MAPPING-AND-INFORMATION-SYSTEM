<?php

namespace App\Filament\Widgets;

use App\Models\Computer;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $workingComputersCount = Computer::where('working', true)->count();
        $notWorkingComputersCount = Computer::where('working', false)->count();
        return [
            Stat::make('Working Computers', $workingComputersCount)
                ->descriptionIcon('heroicon-m-hand-thumb-down')
                ->description('Ready to Use')
                ->descriptionIcon('heroicon-m-hand-thumb-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            Stat::make('Defective Computers', $notWorkingComputersCount)
                ->description('Needs Fixing')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning')
                ->chart([7, 2, 10, 3, 12, 2, 17]),
            Stat::make('Computers', Computer::query()->count())
                ->description('Total amount of computers')
                ->descriptionIcon('heroicon-m-computer-desktop')

                // ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('success')


        ];
    }
}
