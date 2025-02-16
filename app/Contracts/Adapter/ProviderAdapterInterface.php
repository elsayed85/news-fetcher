<?php

namespace App\Contracts\Adapter;

use App\Dtos\ArticleDto;

interface ProviderAdapterInterface extends AdapterInterface
{
    public function normalize(array $payload): ArticleDto;

    public function extractArticles(array $response): array;
}
