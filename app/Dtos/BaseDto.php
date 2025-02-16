<?php

namespace App\Dtos;

use App\Contracts\DtoInterface;

abstract class BaseDto implements DtoInterface
{
    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
