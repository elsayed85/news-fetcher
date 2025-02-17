<?php

namespace App\Traits;

use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use App\Models\User\PreferredAuthor;
use App\Models\User\PreferredCategory;
use App\Models\User\PreferredSource;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPreferredNews
{
    public function preferredSources(): BelongsToMany
    {
        return $this->belongsToMany(Source::class, (new PreferredSource())->getTable(), 'user_id', 'source_id');
    }

    public function preferredCategories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, (new PreferredCategory())->getTable(), 'user_id', 'category_id');
    }

    public function preferredAuthors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class, (new PreferredAuthor())->getTable(), 'user_id', 'author_id');
    }
}
