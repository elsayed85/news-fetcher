<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    protected function getResourceData(): array
    {
        return [];
    }

    public function toArray(Request $request): array
    {
        return array_merge($this->getResourceData(), parent::toArray($request));
    }
}
