<?php

namespace App\Repositories;

use App\Contracts\Repositories\BaseRepositoryInterface;
use App\Filters\BaseFilter;
use App\Models\Article;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected Model $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function all(): array
    {
        return $this->model->all()->toArray();
    }

    public function find(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findWhereIn(string $column, array $values): Collection
    {
        return $this->model->whereIn($column, $values)->get();
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function firstOrCreate(array $match, array $data): Model
    {
        return $this->model->firstOrCreate($match, $data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->where('id', $id)->update($data);
    }

    public function delete(int $id): bool
    {
        return $this->model->destroy($id) > 0;
    }

    public function upsert(array $data, array $uniqueBy, array $update): void
    {
        $this->model->upsert($data, $uniqueBy, $update);
    }

    public function search(BaseFilter $filter, $with = []): \Illuminate\Support\Collection
    {
        return $this->model
            ->with($with)
            ->filter($filter)
            ->latest()
            ->get();
    }

    public function searchPaginated(BaseFilter $filter, $perPage = 10, $with = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->model
            ->with($with)
            ->filter($filter)
            ->latest()
            ->paginate($perPage);
    }

    public function findById(int $id): ?Article
    {
        return $this->model->find($id);
    }
}
