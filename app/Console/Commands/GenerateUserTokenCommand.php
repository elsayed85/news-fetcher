<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateUserTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user-token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new user token';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = User::first();

        if (!$user) {
            $this->error('No user found');
            return;
        }

        $token = $user->createToken('user-token')->plainTextToken;

        $this->info("User token: $token");
    }
}
