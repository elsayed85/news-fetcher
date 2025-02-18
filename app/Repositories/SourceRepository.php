<?php

namespace App\Repositories;

use App\Contracts\Repositories\SourceRepositoryInterface;
use App\Models\Source;

class SourceRepository extends BaseRepository implements SourceRepositoryInterface
{
    public function __construct(Source $model)
    {
        parent::__construct($model);
    }

    public function findOrCreate(string $name): Source
    {
        return Source::firstOrCreate(['name' => $name]);
    }
}
