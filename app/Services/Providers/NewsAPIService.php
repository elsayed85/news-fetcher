<?php

namespace App\Services\Providers;

use App\Enums\NewsProvider;

class NewsAPIService extends BaseService
{
    public function __construct()
    {
        parent::__construct(NewsProvider::NEWS_API);
    }

    protected function setBaseConfig(): void
    {
        $this->baseUrl = $this->config['base_url'];
    }

    protected function setAuthHeaders(): void
    {
        $this->queryParams[$this->config['api_key_param']] = $this->config['api_key'];
    }

    protected function getEndpoint(): string
    {
        return $this->config['endpoints']['news'];
    }
}
