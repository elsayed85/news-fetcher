<?php

namespace App\Adapters\Providers;

use App\Dtos\ArticleDto;
use App\Enums\NewsProvider;

class NytAdapter extends BaseProviderAdapter
{
    public function extractArticles(array $response): array
    {
        return $response['response']['docs'] ?? [];
    }

    public function normalize(array $payload): ArticleDTO
    {
        return new ArticleDTO(
            source: NewsProvider::NYT->value,
            title: $payload['headline']['main'] ?? '',
            description: $payload['abstract'] ?? '',
            content: $payload['lead_paragraph'] ?? '',
            url: $payload['web_url'] ?? '',
            imageUrl: $this->extractImageUrl($payload['multimedia'] ?? []),
            publishedAt: $this->formatPublishedAt($payload['pub_date'] ?? ''),
            author: $payload['byline']['original'] ?? '',
            category: $payload['section_name'] ?? '',
        );
    }

    private function extractImageUrl(array $multimedia): string
    {
        $imageUrl = '';
        foreach ($multimedia as $media) {
            if ($media['type'] === 'image') {
                $imageUrl = 'https://www.nytimes.com/' . $media['url'];
                break;
            }
        }
        return $imageUrl;
    }
}
