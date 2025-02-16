<?php

namespace App\Jobs\Guardian;

use App\Builders\GuardianRequestBuilder;
use App\Exceptions\News\RequestFailed;
use App\Jobs\ProviderBaseJob;
use App\Services\Providers\GuardianService;

class FetchAndSaveJob extends ProviderBaseJob
{
    public function __construct(
        public string  $section,
        public ?string $fromDate = null,
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
            dtos: (new GuardianService())->fetchAndNormalizeArticles(
                builder: (new GuardianRequestBuilder())
                    ->setSection(section: $this->section)
                    ->setPage(page: $this->page)
                    ->when(
                        value: $this->fromDate,
                        callback: fn(GuardianRequestBuilder $builder) => $builder->setFromDate(fromDate: $this->fromDate)
                    )
            )
        );
    }
}
