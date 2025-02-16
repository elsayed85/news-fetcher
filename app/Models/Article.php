<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    public $timestamps = false;
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

    public function author() : BelongsTo
    {
        return $this->belongsTo(Author::class)->withDefault([
            'name' => 'Unknown',
        ]);
    }

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault([
            'name' => 'Uncategorized',
        ]);
    }

    public function source() : BelongsTo
    {
        return $this->belongsTo(Source::class)->withDefault([
            'name' => 'Unknown',
        ]);
    }
}
