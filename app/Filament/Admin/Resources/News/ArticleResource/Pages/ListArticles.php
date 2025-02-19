<?php

namespace App\Filament\Admin\Resources\News\ArticleResource\Pages;

use App\Filament\Admin\Resources\News\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
