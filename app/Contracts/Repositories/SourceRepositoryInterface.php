<?php

namespace App\Contracts\Repositories;

use App\Models\Source;

interface SourceRepositoryInterface extends BaseRepositoryInterface
{
    public function findOrCreate(string $name): Source;
}
