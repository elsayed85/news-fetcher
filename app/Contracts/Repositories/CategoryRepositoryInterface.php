<?php

namespace App\Contracts\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface extends BaseFindOrCreateRepositoryInterface
{
    public function findOrCreate(string $name): Category;
}
