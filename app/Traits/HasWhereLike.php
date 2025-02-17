<?php

namespace App\Traits;

trait HasWhereLike
{
    public function scopeWhereLike($query, $column, $value)
    {
        return $query->where($column, 'LIKE', $value);
    }
}
