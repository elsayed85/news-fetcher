<?php

namespace App\Dtos;

use App\Contracts\Repositories\SourceRepositoryInterface;
use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;

class ArticleDto extends BaseDto
{
    public function __construct(
        public string $source,
        public string $title,
        public string $description,
        public string $content,
        public string $url,
        public string $imageUrl,
        public string $publishedAt,
        public string $author,
        public string $category
    )
    {
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getCategory(): string
    {
        return $this->category;
    }
}
