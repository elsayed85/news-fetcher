<?php

namespace App\Services\Content;

use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Filters\Content\AuthorFilter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class AuthorService
{
    protected AuthorRepositoryInterface $authorRepository;

    public function __construct(AuthorRepositoryInterface $authorRepository)
    {
        $this->authorRepository = $authorRepository;
    }

    public function list(Request $request): Collection
    {
        return $this->authorRepository->search(filter: new AuthorFilter($request));
    }

    public function listPaginated(Request $request, $perPage = 10): LengthAwarePaginator
    {
        return $this->authorRepository->searchPaginated(filter: new AuthorFilter($request), perPage: $perPage);
    }
}
