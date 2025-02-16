<?php

namespace App\Adapters\Providers;

use App\Contracts\Adapter\ProviderAdapterInterface;

abstract class BaseProviderAdapter implements ProviderAdapterInterface
{
    protected function formatPublishedAt(string $publishedAt): string
    {
        return date('Y-m-d H:i:s', strtotime($publishedAt));
    }
}
