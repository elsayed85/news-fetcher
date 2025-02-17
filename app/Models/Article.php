<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\HasWhereLike;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use Filterable, HasWhereLike;

    public $timestamps = true;
    protected $casts = [
        'published_at' => 'datetime',
    ];
    protected $fillable = [
        'title',
        'description',
        'content',
        'url',
        'image_url',
        'source_id',
        'author_id',
        'category_id',
        'published_at',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class)->withDefault([
            'name' => 'Unknown',
        ]);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Uncategorized',
        ]);
    }

    public function source(): BelongsTo
    {
        return $this->belongsTo(Source::class)->withDefault([
            'name' => 'Unknown',
        ]);
    }
}
