<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Room;
use Filament\Tables;
use App\Models\Floor;
use App\Models\Building;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Placeholder;
use App\Filament\Resources\BuildingResource;
use App\Filament\Resources\RoomResource\Pages;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\RoomResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;

class RoomResource extends Resource
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
                    ->dateTime('m-d-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('m-d-Y')
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
                    Tables\Actions\ViewAction::make(),
                    // Tables\Actions\Action::make('Download Layout')
                    // ->icon('heroicon-o-map')
                    // ->color('info'),
                    Tables\Actions\EditAction::make()->color('primary'),
                    Tables\Actions\DeleteAction::make(),
                    // Tables\Actions\Action::make('printLayout')
                    //     ->label('Print Layout')
                    //     ->icon('heroicon-o-printer')
                    //     ->color('secondary')
                    //     ->url(fn ($record) => route('layout.print', ['roomId' => $record->id]))
                    //     ->openUrlInNewTab(),
                ])->color('blue'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'create' => Pages\CreateRoom::route('/create'),
            'edit' => Pages\EditRoom::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
