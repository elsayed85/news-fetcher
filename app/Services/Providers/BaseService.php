<?php

namespace App\Services\Providers;

use App\Contracts\Adapter\ProviderAdapterInterface;
use App\Contracts\ProviderInterface;
use App\Contracts\RequestBuilderInterface;
use App\Enums\NewsProvider;
use App\Exceptions\News\AdapterNotFound;
use App\Exceptions\News\RequestFailed;
use App\Factories\AdapterFactory;
use Illuminate\Support\Facades\Http;

abstract class BaseService implements ProviderInterface
{
    protected string $baseUrl;
    protected array $headers = [];
    protected array $queryParams = [];
    protected NewsProvider $provider;
    protected ProviderAdapterInterface $adapter;
    protected array $config;

    /**
     * @throws AdapterNotFound
     */
    public function __construct(NewsProvider $provider)
    {
        $this->provider = $provider;
        $this->config = config('news.providers.' . $this->provider->value);
        $this->setBaseConfig();
        $this->setAuthHeaders();
        $this->adapter = AdapterFactory::getAdapter($this->provider);
    }

    abstract protected function getEndpoint(): string;

    abstract protected function setBaseConfig(): void;

    abstract protected function setAuthHeaders(): void;

    /**
     * @throws RequestFailed
     */
    public function fetchArticles(RequestBuilderInterface $builder): array
    {
        return $this->makeRequest($this->getEndpoint(), $builder->build());
    }

    /**
     * @throws RequestFailed
     */
    public function fetchAndNormalizeArticles(RequestBuilderInterface $builder): array
    {
        $rawResponse = $this->fetchArticles($builder);
        $articles = $this->adapter->extractArticles($rawResponse);
        return array_map(fn($article) => $this->adapter->normalize($article), $articles);
    }

    protected function getTimeout(): int
    {
        return $this->config['timeout'];
    }

    protected function getRetryTimes(): int
    {
        return $this->config['retry']['times'];
    }

    protected function getRetrySleep(): int
    {
        return $this->config['retry']['sleep'];
    }

    /**
     * @throws RequestFailed
     */
    protected function makeRequest(string $endpoint, array $params = []): array
    {
        $response = Http::withHeaders($this->headers)
            ->timeout($this->getTimeout())
            ->retry($this->getRetryTimes(), $this->getRetrySleep())
            ->get($this->baseUrl . "/" . $endpoint, array_merge($this->queryParams, $params));

        if ($response->failed()) {
            throw new RequestFailed($this->provider->value, $response->json(), $response->status());
        }

        return $response->json();
    }
}
