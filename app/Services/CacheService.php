<?php

namespace App\Services;

use App\Contracts\CacheServiceInterface;
use Closure;
use Illuminate\Support\Facades\Cache;

class CacheService implements CacheServiceInterface
{
    public function rememberForever($key, Closure $callback)
    {
        return Cache::rememberForever($key, $callback);
    }
}
