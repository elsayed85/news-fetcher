<?php

namespace App\Console\Commands\Providers\Guardian;

use App\Console\Commands\Providers\BaseCommand;
use App\Contracts\ProviderJobInterface;
use App\Jobs\Guardian\FetchAndSaveJob;

class JobDispatcherCommand extends BaseCommand
{
    protected $signature = 'guardian:fetch-and-save
                                {section : The section to fetch articles from}
                                {--from-date=2024-01-01 : The date from which to fetch articles}
                                {--page=1 : The page number to fetch articles from}';

    protected $description = 'Fetch articles from The Guardian API and save them to the database';

    protected function getJob(): ProviderJobInterface
    {
        $options = $this->options();
        return new FetchAndSaveJob(
            section: $this->argument('section'),
            fromDate: $options['from-date'],
            page: $options['page']
        );
    }

    protected function getQueueName(): string
    {
        return 'guardian';
    }
}
