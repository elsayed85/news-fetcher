<?php

namespace App\Services\Providers;

use App\Enums\NewsProvider;

class GuardianService extends BaseService
{
    public function __construct()
    {
        parent::__construct(NewsProvider::GUARDIAN);
    }

    protected function setBaseConfig(): void
    {
        $this->config = config('news.providers.' . $this->provider->value);
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
