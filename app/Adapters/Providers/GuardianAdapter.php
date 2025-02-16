<?php

namespace App\Adapters\Providers;

use App\Dtos\ArticleDto;
use App\Enums\NewsProvider;

class GuardianAdapter extends BaseProviderAdapter
{
    public function extractArticles(array $response): array
    {
        return $response['response']['results'] ?? [];
    }

    public function normalize(array $payload): ArticleDto
    {
        return new \App\Dtos\ArticleDto(
            source: $payload['source']['name'] ?? NewsProvider::GUARDIAN->value,
            title: $payload['webTitle'] ?? '',
            description: $payload['fields']['trailText'] ?? '',
            content: $payload['fields']['body'] ?? '',
            url: $payload['webUrl'] ?? '',
            imageUrl: $payload['fields']['thumbnail'] ?? '',
            publishedAt: $this->formatPublishedAt($payload['webPublicationDate'] ?? ''),
            author: $payload['fields']['byline'] ?? 'Unknown',
            category: $payload['pillarName'] ?? 'General'
        );
    }
}
