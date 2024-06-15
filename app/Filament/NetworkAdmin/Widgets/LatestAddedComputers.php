<?php

namespace App\Filament\NetworkAdmin\Widgets;

use Filament\Tables;
use App\Models\Computer;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Route;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestAddedComputers extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    protected function heading(): string
    {
        return 'Reports';
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(Computer::query())
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('computerName'),
                Tables\Columns\TextColumn::make('room.roomName'),
                Tables\Columns\TextColumn::make('created_at'),
                Tables\Columns\IconColumn::make('working')
                ->boolean(),
            ]);
    }
    // public static function canView(): bool
    // {
    //     // Check if the current route is NOT the dashboard route
    //     return !Route::currentRouteNamed('filament.admin.pages.dashboard');
    // }

}
