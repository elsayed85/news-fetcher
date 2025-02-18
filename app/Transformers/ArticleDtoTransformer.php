<?php

namespace App\Transformers;

use App\Contracts\CacheServiceInterface;
use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\SourceRepositoryInterface;
use App\Contracts\Transformers\TransformerInterface;
use App\Dtos\ArticleDatabaseDto;
use App\Dtos\ArticleDto;

class ArticleDtoTransformer implements TransformerInterface
{
    public function __construct(
        protected SourceRepositoryInterface   $sourceRepository,
        protected AuthorRepositoryInterface   $authorRepository,
        protected CategoryRepositoryInterface $categoryRepository,
        protected CacheServiceInterface       $cacheService
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
            sourceId: $this->cacheService->rememberForever(
                "source.{$data->getSource()}",
                fn() => $this->sourceRepository->findOrCreate($data->getSource())->getKey()
            ),
            authorId: $this->cacheService->rememberForever(
                "author.{$data->getAuthor()}",
                fn() => $this->authorRepository->findOrCreate($data->getAuthor())->getKey()
            ),
            categoryId: $this->cacheService->rememberForever(
                "category.{$data->getCategory()}",
                fn() => $this->categoryRepository->findOrCreate($data->getCategory())->getKey()
            )
        );
    }
}
