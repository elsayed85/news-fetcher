<?php

namespace App\Contracts;

use Closure;

interface CacheServiceInterface
{
    public function rememberForever($key, Closure $callback);
}
