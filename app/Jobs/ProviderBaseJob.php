<?php

namespace App\Jobs;

use App\Contracts\ProviderJobInterface;
use App\Services\Content\ArticleService;

abstract class ProviderBaseJob extends BaseJob implements ProviderJobInterface
{
    function saveArticles(array $dtos = []): array
    {
        return app(ArticleService::class)->storeMultipleArticles(dtos: $dtos);
    }
}
