<?php

namespace App\Repositories;

use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Cache;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function findOrCreate(string $name): Category
    {
        return Cache::rememberForever("category_{$name}", function () use ($name) {
            return Category::firstOrCreate(['name' => $name]);
        });
    }
}
