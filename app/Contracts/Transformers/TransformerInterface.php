<?php

namespace App\Contracts\Transformers;

interface TransformerInterface
{
    public function transform(mixed $data): mixed;
}
