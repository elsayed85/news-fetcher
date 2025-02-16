<?php

namespace App\Builders;

use App\Contracts\RequestBuilderInterface;
use Illuminate\Support\Traits\Conditionable;

abstract class BaseRequestBuilder implements RequestBuilderInterface
{
    use Conditionable;

    protected array $params = [];

    abstract public function build(): array;

    public function setPage(int $page): self
    {
        $this->params['page'] = $page;
        return $this;
    }
}
