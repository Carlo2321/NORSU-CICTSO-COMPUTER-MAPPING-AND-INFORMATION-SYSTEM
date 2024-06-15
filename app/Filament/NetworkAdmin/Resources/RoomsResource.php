<?php

namespace App\Filament\NetworkAdmin\Resources;

use Filament\Forms;
use App\Models\Room;
use Filament\Tables;
use App\Models\Floor;
use App\Models\Rooms;
use App\Models\Building;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RoomResource\Pages\EditRoom;
use App\Filament\Resources\RoomResource\Pages\CreateRoom;
use App\Filament\NetworkAdmin\Resources\RoomsResource\Pages;
use App\Filament\NetworkAdmin\Resources\RoomsResource\RelationManagers;

class RoomsResource extends Resource
{
    protected static ?string $model = Room::class;

    protected static ?string $navigationIcon = 'ri-door-closed-line';

    protected static ?string $navigationGroup = 'Computer Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Input room details')
                ->schema([
                Forms\Components\TextInput::make('roomName')->label('Room Name')
                    ->required(),
                Forms\Components\Select::make('building_id')
                    ->native(false)
                    ->relationship('building', 'buildingName')
                    ->label('Building')
                    ->options(
                        Building::all()->pluck('buildingName', 'id')->toArray()
                    )->required()
                    ->createOptionForm([
                            Forms\Components\TextInput::make('buildingName')->label('Building Name')
                            ->required()
                    ]),
                Forms\Components\Select::make('floor_id')
                    ->native(false)
                    ->relationship('floor', 'floorNumber')
                    ->label('Floor')
                    ->options(
                        Floor::all()->pluck('floorNumber', 'id')->toArray()
                    )->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('floorNumber')->label('Floor')
                        ->required()
                ]),
                ])->columns(3)
            ]);

    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('roomName')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('building.buildingName')
                    ->label('Building')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('numberOfComputers')
                //     ->label('Number of Computers'),
                Tables\Columns\TextColumn::make('computers_count')->counts('computers')
                    ->sortable()
                    ->label('Number of Computers'),
                Tables\Columns\TextColumn::make('floor.floorNumber')
                    ->label('Floor')
                    ->columnSpanFull()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('not_working_count')
                //     ->label('Not Working Computers')
                //     ->formatStateUsing(fn($record) => $record->computers->where('working', false)->count())
                //     ->sortable(),

            ])->defaultSort('roomName')
            ->filters([
                SelectFilter::make('building')
                ->relationship('building', 'buildingName')
                ->native(false),
                SelectFilter::make('floor')
                ->relationship('floor', 'floorNumber')
                ->native(false),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    // Tables\Actions\ViewAction::make(),
                    // Tables\Actions\EditAction::make()->color('primary'),
                    // Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('map')
                    ->url('/building-button', shouldOpenInNewTab: true)

                    ->action(function ($record) {
                        $roomName = optional($record->room)->roomName;
                        $roomId = $record->room_id;

                        if ($roomName) {
                            switch (strtolower($roomName)) {
                                case 'cas106':
                                    return redirect()->route('cas106', ['roomId' => $roomId]);
                                case 'cas105':
                                    return redirect()->route('cas105', ['roomId' => $roomId]);
                                case 'cas104':
                                    return redirect()->route('cas104', ['roomId' => $roomId]);
                                case 'cas103':
                                    return redirect()->route('cas103', ['roomId' => $roomId]);
                                case 'cas102':
                                    return redirect()->route('cas102', ['roomId' => $roomId]);
                                case 'c-i-c-t-s-o':
                                    return redirect()->route('c-i-c-t-s-o', ['roomId' => $roomId]);
                                case 'csit-faculty':
                                    return redirect()->route('csit-faculty', ['roomId' => $roomId]);
                                case 'skylab':
                                    return redirect()->route('skylab', ['roomId' => $roomId]);
                                default:
                                    if (strpos($roomName, 'cas') !== false && strpos($roomName, 'floor') !== false) {
                                        $floorNumber = substr($roomName, 3, 1); // Extract the floor number
                                        $routeName = "cas{$floorNumber}th-floor"; // Construct the route name
                                        return redirect()->route($routeName, ['floorId' => $roomId]);

                                    }
                            }
                        }
                        return redirect()->route('building-button');
                    })

                        ->icon('heroicon-o-map')
                        ->color('warning')
                ])->color('blue'),

            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRooms::route('/'),
            'create' => CreateRoom::route('/create'),
            'edit' => EditRoom::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
