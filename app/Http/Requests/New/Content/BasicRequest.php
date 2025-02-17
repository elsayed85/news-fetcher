<?php

namespace App\Http\Requests\New\Content;

use App\Http\Requests\New\BaseRequest;

abstract class BasicRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "name" => ['nullable', 'string'],
        ];
    }
}
