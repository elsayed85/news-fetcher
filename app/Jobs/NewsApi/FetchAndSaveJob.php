<?php

namespace App\Jobs\NewsApi;

use App\Builders\NewsAPIRequestBuilder;
use App\Exceptions\News\RequestFailed;
use App\Jobs\ProviderBaseJob;
use App\Services\Providers\NewsAPIService;

class FetchAndSaveJob extends ProviderBaseJob
{
    public function __construct(
        public string $category,
        public int    $page = 1,
    )
    {
        parent::__construct();
    }

    /**
     * @throws RequestFailed
     */
    public function handle(): void
    {
        $this->saveArticles(
            dtos: (new NewsAPIService())->fetchAndNormalizeArticles(
                builder: (new NewsAPIRequestBuilder())
                    ->setCategory(category: $this->category)
                    ->setPage(page: $this->page)
            )
        );
    }
}
