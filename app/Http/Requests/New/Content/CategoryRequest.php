<?php

namespace App\Http\Requests\New\Content;


class CategoryRequest extends BasicRequest
{
    public function rules(): array
    {
        return [
            "name" => ['nullable', 'string', 'max:50'],
        ];
    }
}
