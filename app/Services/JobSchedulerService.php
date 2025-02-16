<?php

namespace App\Services;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class JobSchedulerService
{
    private array $jobs = [
        [
            'command' => \App\Console\Commands\Providers\Nyt\JobDispatcherCommand::class,
            'params' => ['query' => 'technology'],
            'log' => 'NYT'
        ],
        [
            'command' => \App\Console\Commands\Providers\NewsApi\JobDispatcherCommand::class,
            'params' => ['category' => 'technology'],
            'log' => 'NewsApi'
        ],
        [
            'command' => \App\Console\Commands\Providers\Guardian\JobDispatcherCommand::class,
            'params' => ['section' => 'technology'],
            'log' => 'Guardian'
        ]
    ];

    public function scheduleJobs(Schedule $schedule): void
    {
        foreach ($this->jobs as $job) {
            $this->scheduleJob($schedule, $job['command'], $job['params'], $job['log']);
        }
    }

    private function scheduleJob(Schedule $schedule, string $command, array $params, string $logPrefix): void
    {
        $schedule->command($command, $params)
            ->daily()
            ->withoutOverlapping()
            ->before(fn() => Log::info("{$logPrefix} fetch job starting."))
            ->after(fn() => Log::info("{$logPrefix} fetch job completed."))
            ->onFailure(fn() => Log::error("{$logPrefix} fetch job failed."));
    }
}
