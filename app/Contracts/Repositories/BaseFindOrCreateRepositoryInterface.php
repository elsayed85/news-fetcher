<?php

namespace App\Contracts\Repositories;

interface BaseFindOrCreateRepositoryInterface extends BaseRepositoryInterface
{
    public function findOrCreate(string $name);
}
