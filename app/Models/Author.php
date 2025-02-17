<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\HasWhereLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Author extends Model
{
    use Filterable, HasWhereLike;

    protected $table = 'authors';
    protected $fillable = ['name'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
