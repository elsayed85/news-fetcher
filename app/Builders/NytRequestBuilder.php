<?php

namespace App\Builders;

class NytRequestBuilder extends BaseRequestBuilder
{
    public function __construct()
    {
        $this->setFields([
            'abstract',
            'byline',
            'lead_paragraph',
            'multimedia',
            'pub_date',
            'section_name',
            'headline',
            'web_url'
        ])->setSort('newest');
    }

    public function setQuery(string $query): self
    {
        $this->params['q'] = $query;
        return $this;
    }

    public function setDateRange(string $beginDate, string $endDate): self
    {
        $this->setStartDate($beginDate)->setEndDate($endDate);
        return $this;
    }


    public function setStartDate(string $startDate): self
    {
        $this->params['begin_date'] = $startDate;
        return $this;
    }

    public function setEndDate(string $endDate): self
    {
        $this->params['end_date'] = $endDate;
        return $this;
    }

    public function setFields(array $fields): self
    {
        $this->params['fl'] = implode(',', $fields);
        return $this;
    }

    public function setSort(string $sort): self
    {
        $this->params['sort'] = $sort;
        return $this;
    }

    public function build(): array
    {
        return $this->params;
    }
}
