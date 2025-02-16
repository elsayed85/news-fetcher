<?php

namespace App\Dtos;

class ArticleDatabaseDto extends BaseDto
{
    public function __construct(
        public string  $title,
        public ?string $description,
        public ?string $content,
        public string  $url,
        public ?string $imageUrl,
        public string  $publishedAt,
        public ?int    $sourceId,
        public ?int    $authorId,
        public ?int    $categoryId
    )
    {
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->content,
            'url' => $this->url,
            'image_url' => $this->imageUrl,
            'published_at' => $this->publishedAt,
            'source_id' => $this->sourceId,
            'author_id' => $this->authorId,
            'category_id' => $this->categoryId,
        ];
    }
}
