<?php

namespace App\Filters;

abstract class BasicModelFilter extends BaseFilter
{
    protected function filterByName(): void
    {
        if ($this->request->has('name')) {
            $this->query->where('name', 'like', '%' . $this->request->input('name') . '%');
        }
    }
}
