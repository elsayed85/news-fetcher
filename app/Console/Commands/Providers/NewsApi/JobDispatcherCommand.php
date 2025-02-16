<?php

namespace App\Console\Commands\Providers\NewsApi;

use App\Console\Commands\Providers\BaseCommand;
use App\Contracts\ProviderJobInterface;
use App\Jobs\NewsApi\FetchAndSaveJob;

class JobDispatcherCommand extends BaseCommand
{
    protected $signature = 'news-api:fetch-and-save
                                {category : The category to fetch articles from}
                                {--page=1 : The page number to fetch articles from}';

    protected $description = 'Fetch articles from The Guardian API and save them to the database';

    protected function getJob(): ProviderJobInterface
    {
        return new FetchAndSaveJob(
            category: $this->argument('category'),
            page: $this->option('page'),
        );
    }

    protected function getQueueName(): string
    {
        return 'news-api';
    }
}
