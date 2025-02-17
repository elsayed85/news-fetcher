<?php

namespace App\Services\Content;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Dtos\ArticleDto;
use App\Filters\Content\ArticleFilter;
use App\Filters\Content\ArticleWithUserPreferenceFilter;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

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

    public function listPaginated(Request $request, $perPage = 10): LengthAwarePaginator
    {
        return $this->articleRepository->searchPaginated(
            filter: new ArticleFilter($request),
            perPage: $perPage,
            with: ['source', 'author', 'category'],
        );
    }

    public function show(int $id)
    {
        return $this->articleRepository->find($id);
    }
}
