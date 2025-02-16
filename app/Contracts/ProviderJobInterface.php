<?php

namespace App\Contracts;

interface ProviderJobInterface
{
    public function handle(): void;

    function saveArticles(array $dtos = []): array;
}
