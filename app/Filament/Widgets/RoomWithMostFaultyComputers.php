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

class RoomWithMostFaultyComputers extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'half';

    protected function heading(): string
    {
        return 'Rooms with Most Faulty Computers';
    }

    public function table(Table $table): Table
    {
        $roomsWithMostFaulty = Room::query()
        ->withCount(['computers as faulty_computers_count' => function ($query) {
            $query->where('working', false);
        }])
        ->orderByDesc('faulty_computers_count')
        ->take(5)
        ->get();

    // Define the table
        return $table
        ->query(Room::query()->whereIn('id', $roomsWithMostFaulty->pluck('id')))
        ->columns([
            Tables\Columns\TextColumn::make('roomName')->label('Room Name'),
            Tables\Columns\TextColumn::make('faulty_computers_count')
                ->label('Faulty Computers')
                ->getStateUsing(function ($record) {
                    // Calculate the count of working computers
                    return $record->computers->where('working', false)->count();
                }),
            ])
        ->actions([
            Action::make('pdf')
                ->label('PDF')
                ->color('success')
                ->icon('heroicon-o-arrow-down-tray')
                ->action(function () use ($roomsWithMostFaulty) {
                    return response()->streamDownload(function () use ($roomsWithMostFaulty) {
                        $htmlContent = Blade::render('pdf1', ['rooms' => $roomsWithMostFaulty]);
                        echo Pdf::loadHtml($htmlContent)->stream();
                    }, 'rooms_with_most_faulty_computers.pdf');
                }),
        ]);
    }
    public static function canView(): bool
    {
        return !Route::currentRouteNamed('filament.admin.pages.dashboard');
    }
}
