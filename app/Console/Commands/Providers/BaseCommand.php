<?php

namespace App\Console\Commands\Providers;

use App\Contracts\ProviderJobInterface;
use Illuminate\Console\Command;

abstract class BaseCommand extends Command
{
    public function handle(): int
    {
        $this->info('Dispatching job...');
        dispatch($this->getJob())->onQueue($this->getQueueName());
        $this->info('Job dispatched!');
        return 0;
    }

    abstract protected function getJob(): ProviderJobInterface;

    protected function getQueueName(): string
    {
        return 'default';
    }
}
