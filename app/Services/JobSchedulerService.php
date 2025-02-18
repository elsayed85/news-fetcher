<?php

namespace App\Services;

use App\Console\Commands\Providers\Guardian\JobDispatcherCommand as GuardianJobDispatcherCommand;
use App\Console\Commands\Providers\NewsApi\JobDispatcherCommand as NewsApiJobDispatcherCommand;
use App\Console\Commands\Providers\Nyt\JobDispatcherCommand as NytJobDispatcherCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\Log;

class JobSchedulerService
{
    private array $jobs = [
        [
            'command' => GuardianJobDispatcherCommand::class,
            'arguments' => ['technology'],
            'options' => [
                '--from-date' => '2024-01-01',
                '--page' => '1'
            ],
            'log' => 'Guardian'
        ],
        [
            'command' => NewsApiJobDispatcherCommand::class,
            'arguments' => ['technology'],
            'options' => [],
            'log' => 'NewsApi'
        ],
        [
            'command' => NytJobDispatcherCommand::class,
            'arguments' => ['technology'],
            'options' => [],
            'log' => 'NYT'
        ]
    ];

    public function scheduleJobs(Schedule $schedule): void
    {
        foreach ($this->jobs as $job) {
            $formattedCommand = $this->formatCommand($job['command'], $job['arguments'], $job['options']);
            $schedule->command($formattedCommand)
                ->daily()
                ->withoutOverlapping()
                ->before(fn() => Log::info("{$job['log']} fetch job starting."))
                ->after(fn() => Log::info("{$job['log']} fetch job completed."))
                ->onFailure(fn() => Log::error("{$job['log']} fetch job failed."));
        }
    }

    private function formatCommand(string $command, array $arguments, array $options): string
    {
        $argString = implode(' ', array_map(fn($arg) => escapeshellarg($arg), $arguments));
        $optString = collect($options)
            ->map(fn($value, $key) => "{$key}=" . escapeshellarg($value))
            ->implode(' ');

        return trim(app($command)->getName() . " {$argString} {$optString}");
    }
}
