<?php

namespace App\Filament\Widgets;

use App\Models\Room;
use Filament\Tables;
use Filament\Tables\Table;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Tables\Actions\Action;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Filament\Widgets\TableWidget as BaseWidget;

class RoomWithMostWorkingComputers extends BaseWidget
{
    protected static ?int $sort = 10;
    protected int | string | array $columnSpan = 'half';

    protected function heading(): string
    {
        return 'Rooms with Most Working Computers';
    }

    public function table(Table $table): Table
    {
        // room query
        $roomsWithMostWorking = Room::query()
        ->withCount(['computers as working_computers_count' => function ($query) {
            $query->where('working', true);
        }])
        ->orderByDesc('working_computers_count')
        ->take(5)
        ->get();

        return $table
        ->query(Room::query()->whereIn('id', $roomsWithMostWorking->pluck('id')))
        ->columns([
            Tables\Columns\TextColumn::make('roomName')->label('Room Name'),
            Tables\Columns\TextColumn::make('working_computers_count')
                ->label('Working Computers')
                ->getStateUsing(function ($record) {
                    return $record->computers->where('working', true)->count();
                }),
            ])
            ->actions([
                Action::make('pdf')
                    ->label('PDF')
                    ->color('success')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function () use ($roomsWithMostWorking) {
                        return response()->streamDownload(function () use ($roomsWithMostWorking) {
                            $htmlContent = Blade::render('pdf', ['rooms' => $roomsWithMostWorking]);
                            echo Pdf::loadHtml($htmlContent)->stream();
                        }, 'rooms_with_most_working_computers.pdf');
                    }),
            ]);
    }

    public static function canView(): bool
    {
        return !Route::currentRouteNamed('filament.admin.pages.dashboard');
    }
}
