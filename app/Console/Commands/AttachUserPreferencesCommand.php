<?php

namespace App\Console\Commands;

use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use App\Models\User;
use Illuminate\Console\Command;
use function Laravel\Prompts\multiselect;

class AttachUserPreferencesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attach:user-preferences';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Attach user preferences to articles';

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

        $this->syncUserPreferences($user, Source::class, 'preferredSources', 'Select preferred sources');
        $this->syncUserPreferences($user, Category::class, 'preferredCategories', 'Select preferred categories');
        $this->syncUserPreferences($user, Author::class, 'preferredAuthors', 'Select preferred authors');
    }

    /**
     * Sync user preferences for a given model and relation.
     */
    protected function syncUserPreferences(User $user, string $modelClass, string $relation, string $label): void
    {
        $items = $modelClass::all();

        if ($items->isEmpty()) {
            $this->warn("No available {$relation} to select.");
            return;
        }

        $selected = $this->getUserSelectedOptions($user, $items, $relation, $label);

        $user->$relation()->sync($selected);
        $this->info("Preferences for {$relation} updated successfully.");
    }

    /**
     * Get user-selected options with preselected choices.
     */
    protected function getUserSelectedOptions(User $user, $items, string $relation, string $label): array
    {
        $options = $items->pluck('name', 'id')->toArray();
        $tableName = $user->$relation()->getModel()->getTable();
        $preselectedIds = $user->$relation()->pluck("{$tableName}.id")->toArray();

        return multiselect(label: $label, options: $options, default: $preselectedIds, required: true);
    }
}
