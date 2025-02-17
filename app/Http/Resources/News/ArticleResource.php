<?php

namespace App\Http\Resources\News;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class ArticleResource extends BaseResource
{
    private bool $withContent = false;

    public function __construct($resource)
    {
        parent::__construct($resource);
    }

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'content' => $this->when($this->withContent, $this->content),
            'url' => $this->url,
            'image_url' => $this->image_url,
            'source' => $this->whenLoaded('source', SourceResource::make($this->source)),
            'author' => $this->whenLoaded('author', AuthorResource::make($this->author)),
            'category' => $this->whenLoaded('category', CategoryResource::make($this->category)),
            'published_at' => $this->published_at->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s')
        ];
    }

    public function withContent(bool $withContent = true): self
    {
        $this->withContent = $withContent;
        return $this;
    }
}
