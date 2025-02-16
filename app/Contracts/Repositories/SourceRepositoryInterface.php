<?php

namespace App\Contracts\Repositories;

use App\Models\Source;

interface SourceRepositoryInterface extends BaseFindOrCreateRepositoryInterface
{
    public function findOrCreate(string $name): Source;
}
