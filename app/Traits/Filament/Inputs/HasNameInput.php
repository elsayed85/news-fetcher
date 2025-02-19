<?php

namespace App\Traits\Filament\Inputs;

use Filament\Forms\Components\TextInput;

trait HasNameInput
{
    public static function getNameInput(): TextInput
    {
        return TextInput::make('name')
            ->label('Name')
            ->placeholder('Enter name')
            ->required();
    }
}
