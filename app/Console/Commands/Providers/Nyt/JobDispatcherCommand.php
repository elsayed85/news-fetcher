<?php

namespace App\Console\Commands\Providers\Nyt;

use App\Console\Commands\Providers\BaseCommand;
use App\Contracts\ProviderJobInterface;
use App\Jobs\Nyt\FetchAndSaveJob;

class JobDispatcherCommand extends BaseCommand
{
    protected $signature = 'nyt:fetch-and-save
                                {query : The query to search for}
                                {--from-date : The date from which to fetch articles}
                                {--to-date : The date to which to fetch articles}
                                {--page=1 : The page number to fetch articles from}';

    protected $description = 'Fetch articles from The Guardian API and save them to the database';

    protected function getJob(): ProviderJobInterface
    {
        $options = $this->options();
        return new FetchAndSaveJob(
            query: $this->argument('query'),
            fromDate: $options['from-date'],
            toDate: $options['to-date'],
            page: $options['page'],
        );
    }

    protected function getQueueName(): string
    {
        return 'nyt';
    }
}
