<?php

namespace App\Contracts;

interface ProviderInterface
{
    public function fetchArticles(RequestBuilderInterface $builder): array;
}
