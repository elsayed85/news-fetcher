<?php

namespace App\Services\Content;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Dtos\ArticleDto;
use App\Models\Article;

class ArticleService
{
    protected ArticleRepositoryInterface $articleRepository;

    public function __construct(ArticleRepositoryInterface $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function storeArticle(ArticleDto $dto): Article
    {
        return $this->articleRepository->store($dto);
    }

    public function storeMultipleArticles(array $dtos): array
    {
        return $this->articleRepository->storeMultiple($dtos);
    }

    public function getArticles(): array
    {
        return $this->articleRepository->all();
    }
}
