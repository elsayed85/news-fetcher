<?php

namespace App\Http\Requests\New\Content;

class ArticleRequest extends BasicRequest
{
    public function rules(): array
    {
        return [
            "query" => ['sometimes', 'nullable', 'string', "max:255"],
            "category" => ['sometimes', 'nullable', 'string', "max:255"],
            "author" => ['sometimes', 'nullable', 'string', "max:255"],
            "source" => ['sometimes', 'nullable', 'string', "max:255"],
            'with_preferred_sources' => ['sometimes', 'boolean'],
            'with_preferred_categories' => ['sometimes', 'boolean'],
            'with_preferred_authors' => ['sometimes', 'boolean'],
            'from_date' => ['sometimes', 'date', 'before_or_equal:to_date'],
            'to_date' => ['sometimes', 'date', 'after_or_equal:from_date'],
        ];
    }
}
