<?php

namespace App\Adapters\Providers;

use App\Dtos\ArticleDto;
use App\Enums\NewsProvider;

class NewsAPIAdapter extends BaseProviderAdapter
{
    public function extractArticles(array $response): array
    {
        return $response['articles'] ?? [];
    }

    public function normalize(array $payload): ArticleDto
    {
        return new \App\Dtos\ArticleDto(
            source: $payload['source']['name'] ?? NewsProvider::NEWS_API->value,
            title: $payload['title'] ?? '',
            description: $payload['description'] ?? '',
            content: $payload['content'] ?? '',
            url: $payload['url'] ?? '',
            imageUrl: $payload['urlToImage'] ?? '',
            publishedAt: $this->formatPublishedAt($payload['publishedAt'] ?? ''),
            author: $payload['author'] ?? 'Unknown',
            category: $payload['category'] ?? 'General'
        );
    }
}
