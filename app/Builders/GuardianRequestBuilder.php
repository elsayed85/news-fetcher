<?php

namespace App\Builders;

class GuardianRequestBuilder extends BaseRequestBuilder
{
    public function __construct()
    {
        $this->setShowFields(['body', 'trailText', 'thumbnail', 'byline']);
    }

    public function setSection(string $section): self
    {
        $this->params['section'] = $section;
        return $this;
    }

    public function setFromDate(string $fromDate): self
    {
        $this->params['from-date'] = $fromDate;
        return $this;
    }

    # show-fields
    public function setShowFields(array $fields): self
    {
        $this->params['show-fields'] = implode(',', $fields);
        return $this;
    }

    public function build(): array
    {
        return $this->params;
    }
}
