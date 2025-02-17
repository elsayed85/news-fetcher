<?php

namespace App\Services\Content;

use App\Contracts\Repositories\SourceRepositoryInterface;
use App\Filters\Content\SourceFilter;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class SourceService
{
    protected SourceRepositoryInterface $sourceRepository;

    public function __construct(SourceRepositoryInterface $sourceRepository)
    {
        $this->sourceRepository = $sourceRepository;
    }

    public function list(Request $request): Collection
    {
        return $this->sourceRepository->search(filter: new SourceFilter($request));
    }

    public function listPaginated(Request $request, $perPage = 10): LengthAwarePaginator
    {
        return $this->sourceRepository->searchPaginated(filter: new SourceFilter($request), perPage: $perPage);
    }
}
