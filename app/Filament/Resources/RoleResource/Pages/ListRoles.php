<?php

namespace App\Filament\Resources\RoleResource\Pages;

use App\Models\Role;
use Filament\Actions;
use App\Filament\Resources\RoleResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListRoles extends ListRecords
{
    protected static string $resource = RoleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->Icon('heroicon-m-plus-circle')
            ->label('Role'),
        ];
    }


}
