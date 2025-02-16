<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Source extends Model
{
    protected $table = 'sources';
    protected $fillable = ['name'];

    public function articles() : HasMany
    {
        return $this->hasMany(Article::class);
    }
}
