<?php

namespace App\Http\Requests\New\Content;

class AuthorRequest extends BasicRequest
{
    public function rules(): array
    {
        return [
            "name" => ['nullable', 'string'],
        ];
    }
}
