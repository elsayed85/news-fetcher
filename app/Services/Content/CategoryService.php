<?php

namespace App\Services\Content;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Filters\Content\CategoryFilter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryService
{
    protected CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function list(Request $request): Collection
    {
        return $this->categoryRepository->search(filter: new CategoryFilter($request));
    }

    public function listPaginated(Request $request, $perPage = 10): LengthAwarePaginator
    {
        return $this->categoryRepository->searchPaginated(filter: new CategoryFilter($request), perPage: $perPage);
    }
}
