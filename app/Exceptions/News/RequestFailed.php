<?php

namespace App\Exceptions\News;

class RequestFailed extends \Exception
{
    public function __construct(string $provider , array $response = [] , $statusCode = 500)
    {
        parent::__construct("Request to provider: " . $provider . " failed with status code: " . $statusCode . " and response: " . json_encode($response));
    }
}
