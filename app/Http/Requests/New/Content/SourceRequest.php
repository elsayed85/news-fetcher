<?php

namespace App\Http\Requests\New\Content;

class SourceRequest extends BasicRequest
{
    public function rules(): array
    {
        return [
            "name" => ['nullable', 'string', 'max:25'],
        ];
    }
}
