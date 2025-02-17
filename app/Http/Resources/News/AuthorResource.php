<?php

namespace App\Http\Resources\News;

use App\Http\Resources\BaseResource;
use Illuminate\Http\Request;

class AuthorResource extends BaseResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name
        ];
    }
}
