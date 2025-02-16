<?php

namespace App\Contracts\Repositories;

use App\Models\Author;

interface AuthorRepositoryInterface extends BaseFindOrCreateRepositoryInterface
{
    public function findOrCreate(string $name): Author;
}
