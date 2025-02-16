<?php

namespace App\Repositories;

use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Models\Author;
use Illuminate\Support\Facades\Cache;

class AuthorRepository extends BaseRepository implements AuthorRepositoryInterface
{
    public function __construct(Author $model)
    {
        parent::__construct($model);
    }

    public function findOrCreate(string $name): Author
    {
        return Cache::rememberForever("author_{$name}", function () use ($name) {
            return Author::firstOrCreate(['name' => $name]);
        });
    }
}
