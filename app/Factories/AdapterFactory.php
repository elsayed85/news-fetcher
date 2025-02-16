<?php

namespace App\Factories;

use App\Adapters\Providers\GuardianAdapter;
use App\Adapters\Providers\NewsAPIAdapter;
use App\Adapters\Providers\NytAdapter;
use App\Contracts\Adapter\ProviderAdapterInterface;
use App\Enums\NewsProvider;
use App\Exceptions\News\AdapterNotFound;

class AdapterFactory
{
    /**
     * @throws AdapterNotFound
     */
    public static function getAdapter(NewsProvider $provider): ProviderAdapterInterface
    {
        return match ($provider) {
            NewsProvider::NEWS_API => new NewsAPIAdapter(),
            NewsProvider::GUARDIAN => new GuardianAdapter(),
            NewsProvider::NYT => new NytAdapter(),
            default => throw new AdapterNotFound($provider->value)
        };
    }
}
