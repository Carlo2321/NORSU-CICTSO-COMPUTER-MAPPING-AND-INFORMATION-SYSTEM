<?php

namespace App\Filament\NetworkAdmin\Resources;

use App\Livewire\Cas1stFloor;
use Filament\Forms;
use App\Models\Room;
use Filament\Tables;
use App\Models\Computer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\NetworkAdmin\Resources\ComputerResource\Pages;
use App\Filament\NetworkAdmin\Resources\ComputerResource\RelationManagers;

class ComputerResource extends Resource
{
    protected static ?string $model = Computer::class;

    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static ?string $navigationGroup = 'Computer Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\Section::make('Input computer details')
                // ->schema([
                //     Forms\Components\TextInput::make('computerName')->label('Host Name') ->required()
                //     ->maxLength(255),
                //     Forms\Components\TextInput::make(name:'macAddress' )->label('Mac Address')->nullable(),
                //     Forms\Components\TextInput::make(name:'ipAddress' )->label('IP address')->nullable(),
                //     Forms\Components\Select::make('room_id')
                //         ->required()
                //         ->native(false)
                //         ->relationship('room', 'roomName')
                //         ->label('Room')
                //         ->options(
                //             Room::all()->pluck('roomName', 'id')->toArray()
                //         ) ->preload()
                //         ->createOptionForm([
                //             Forms\Components\TextInput::make('roomName')->label('Room Name')
                //                 ->required()
                //         ]),

                //     Forms\Components\Toggle::make('working')
                //         ->required(),
                //     ])->columns(2),




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('computerName')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('room.roomName')
                    ->label('Room')
                    ->searchable()
                    ->sortable(),


                // Tables\Columns\TextColumn::make('status')
                // ->label('Status')
                // ->sortable()
                // ->color('success'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\IconColumn::make('working')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

            ])
            ->filters([
                Tables\Filters\SelectFilter::make('working')
                    ->options([
                        'Not working',
                        'Working'

                    ])->native(false),
                Tables\Filters\SelectFilter::make('room')
                ->relationship('room', 'roomName')
                ->native(false),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('map')
                    ->action(function($record) {
                        // Get the room ID from the computer record
                        $roomId = $record->room_id;

                        // Determine the correct route based on the room ID
                        switch ($roomId) {
                            case 102:
                                return redirect()->route('cas102', ['roomId' => $roomId]);
                            case 103:
                                return redirect()->route('cas103', ['roomId' => $roomId]);
                            case 104:
                                return redirect()->route('cas104', ['roomId' => $roomId]);
                            case 105:
                                return redirect()->route('cas105', ['roomId' => $roomId]);
                            case 106:
                                return redirect()->route('cas106', ['roomId' => $roomId]);
                            case 101: // Adjust the case as per your routes
                                return redirect()->route('cas1st-floor', ['floorId' => $roomId]);
                            default:
                                // If no matching case, handle appropriately (e.g., redirect to a default route)
                                break;
                        }
                        return redirect()->route('building-button');

                    })
                        ->icon('heroicon-o-map')
                        ->color('warning'),
                ])->color('blue'),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }
    // public static function infolist(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             TextEntry::make('computerName')->label('Hostname'),
    //             TextEntry::make('room.roomName')->label('Room'),
    //             TextEntry::make('working')->label('Working'),
    //         ]);
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListComputers::route('/'),
            // 'create' => Pages\CreateComputer::route('/create'),
            // 'edit' => Pages\EditComputer::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
    public static function getNavigationBadgeColor(): string|array|null
    {
        return 'info';
    }
}
