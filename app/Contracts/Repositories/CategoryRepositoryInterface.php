<?php

namespace App\Contracts\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function findOrCreate(string $name): Category;
}
