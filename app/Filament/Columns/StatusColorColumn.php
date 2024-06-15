<?php

namespace App\Filament\Columns;

use Filament\Tables\Columns\TextColumn;

class StatusColorColumn extends TextColumn
{
    public function color($status): string|array|null
    {
        if ($status === 'working') {
            return 'success'; // Green color for "working"
        } elseif ($status === 'not_working') {
            return 'danger'; // Red color for "not working"
        }

        return parent::color($status);
    }
}
