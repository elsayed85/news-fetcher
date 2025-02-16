<?php

namespace App\Adapters\Transformers;

use App\Contracts\Repositories\SourceRepositoryInterface;
use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Transformers\TransformerInterface;
use App\Dtos\ArticleDto;
use App\Dtos\ArticleDatabaseDto;

class ArticleDtoTransformer implements TransformerInterface
{
    public function __construct(
        protected SourceRepositoryInterface   $sourceRepository,
        protected AuthorRepositoryInterface   $authorRepository,
        protected CategoryRepositoryInterface $categoryRepository
    )
    {
    }

    public function transform(mixed $data): ArticleDatabaseDto
    {
        if (!$data instanceof ArticleDto) {
            throw new \InvalidArgumentException("Expected instance of ArticleDto");
        }

        return new ArticleDatabaseDto(
            title: $data->title,
            description: $data->description ?? null,
            content: $data->content ?? null,
            url: $data->url,
            imageUrl: $data->imageUrl ?? null,
            publishedAt: $data->publishedAt,
            sourceId: $this->sourceRepository->findOrCreate($data->getSource())->getKey(),
            authorId: $this->authorRepository->findOrCreate($data->getAuthor())->getKey(),
            categoryId: $this->categoryRepository->findOrCreate($data->getCategory())->getKey()
        );
    }
}
