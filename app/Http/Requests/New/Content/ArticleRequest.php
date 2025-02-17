<?php

namespace App\Http\Requests\New\Content;

class ArticleRequest extends BasicRequest
{
    public function rules(): array
    {
        return [
            "query" => ['nullable', 'string', "max:255"],
            "category" => ['nullable', 'string', "max:255"],
            "author" => ['nullable', 'string', "max:255"],
            "source" => ['nullable', 'string', "max:255"],
        ];
    }
}
