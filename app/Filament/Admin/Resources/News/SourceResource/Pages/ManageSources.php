<?php

namespace App\Filament\Admin\Resources\News\SourceResource\Pages;

use App\Filament\Admin\Resources\News\SourceResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSources extends ManageRecords
{
    protected static string $resource = SourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
