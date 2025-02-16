<?php

namespace App\Jobs\Nyt;

use App\Builders\NytRequestBuilder;
use App\Exceptions\News\RequestFailed;
use App\Jobs\ProviderBaseJob;
use App\Services\Providers\NytService;

class FetchAndSaveJob extends ProviderBaseJob
{
    public function __construct(
        public string  $query,
        public ?string $fromDate = null,
        public ?string $toDate = null,
        public int     $page = 1,
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
            dtos: (new NytService())->fetchAndNormalizeArticles(
                builder: (new NytRequestBuilder())
                    ->setQuery(query: $this->query)
                    ->setPage(page: $this->page)
                    ->when(
                        value: $this->fromDate,
                        callback: fn(NytRequestBuilder $builder) => $builder->setStartDate(startDate: $this->fromDate)
                    )
                    ->when(
                        value: $this->toDate,
                        callback: fn(NytRequestBuilder $builder) => $builder->setEndDate(endDate: $this->toDate)
                    )
            )
        );
    }
}
