<?php

namespace App\Builders;

class NewsAPIRequestBuilder extends BaseRequestBuilder
{
    public function __construct()
    {
        $this->setCountry('us');
    }

    public function setCountry(string $country): self
    {
        $this->params['country'] = $country;
        return $this;
    }

    public function setCategory(string $category): self
    {
        $this->params['category'] = $category;
        return $this;
    }

    public function build(): array
    {
        return $this->params;
    }
}
