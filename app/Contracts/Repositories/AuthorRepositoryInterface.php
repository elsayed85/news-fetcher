<?php

namespace App\Contracts\Repositories;

use App\Models\Author;

interface AuthorRepositoryInterface extends BaseRepositoryInterface
{
    public function findOrCreate(string $name): Author;
}
