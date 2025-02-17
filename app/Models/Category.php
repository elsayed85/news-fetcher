<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\HasWhereLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use Filterable, HasWhereLike;


    protected $table = 'categories';
    protected $fillable = ['name'];

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }
}
