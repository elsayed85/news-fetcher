<?php

namespace App\Filters\Content;

use App\Filters\BaseFilter;

class ArticleFilter extends BaseFilter
{
    protected function filterByQuery(): void
    {
        if ($this->request->has('query')) {
            $queryParam = $this->request->input('query');
            $this->query->where(function ($q) use ($queryParam) {
                $q->where('title', 'LIKE', '%' . $queryParam . '%')
                    ->orWhere('content', 'LIKE', '%' . $queryParam . '%');
            });
        }
    }

    protected function filterByCategory(): void
    {
        if ($this->request->has('category')) {
            $this->query->whereHas('category', fn($q) => $q->whereLike('name', '%' . $this->request->input('category') . '%'));
        }
    }

    protected function filterBySource(): void
    {
        if ($this->request->has('source')) {
            $this->query->whereHas('source', fn($q) => $q->whereLike('name', '%' . $this->request->input('source') . '%'));
        }
    }

    protected function filterByAuthor(): void
    {
        if ($this->request->has('author')) {
            $this->query->whereHas('author', fn($q) => $q->whereLike('name', '%' . $this->request->input('author') . '%'));
        }
    }

    protected function filterByDateRange(): void
    {
        if ($this->request->has('from_date')) {
            $this->query->whereDate('published_at', '>=', $this->request->input('from_date'));
        }
        if ($this->request->has('to_date')) {
            $this->query->whereDate('published_at', '<=', $this->request->input('to_date'));
        }
    }
}
