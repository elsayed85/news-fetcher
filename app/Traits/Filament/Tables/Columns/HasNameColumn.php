<?php

namespace App\Traits\Filament\Tables\Columns;

use Filament\Tables\Columns\TextColumn;

trait HasNameColumn
{
    public static function getNameColumn(): TextColumn
    {
        return TextColumn::make('name')
            ->label('Name')
            ->searchable()
            ->sortable();
    }
}
