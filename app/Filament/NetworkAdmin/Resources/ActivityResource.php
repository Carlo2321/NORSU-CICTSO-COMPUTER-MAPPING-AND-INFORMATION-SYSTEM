<?php

namespace App\Filament\NetworkAdmin\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\NetworkAdmin\Resources\ActivityResource\Pages;
use App\Filament\NetworkAdmin\Resources\ActivityResource\RelationManagers;
use Filament\Tables\Columns\TextColumn;


class ActivityResource extends Resource
{

    protected static ?string $model = Activity::class;

    protected static ?string $navigationIcon = 'bi-activity';

    protected static ?string $navigationGroup = 'Logs';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('causer_id')
                    ->label('Logged By'),
                TextColumn::make('description'),
                TextColumn::make('causer_type')
                    ->label('Model'),
                // TextColumn::make('properties')
                //     ->label('Attributes'),
                TextColumn::make('created_at')
                    ->label('Logged At')
                    ->dateTime('d-M-Y'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListActivities::route('/'),
            // 'create' => Pages\CreateActivity::route('/create'),
            // 'edit' => Pages\EditActivity::route('/{record}/edit'),
        ];
    }
    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
