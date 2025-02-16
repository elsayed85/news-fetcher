<?php

namespace App\Exceptions\News;

class AdapterNotFound extends \Exception
{
    public function __construct(string $provider)
    {
        parent::__construct("No adapter found for provider: " . $provider);
    }
}
