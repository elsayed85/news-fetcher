<?php

namespace App\Contracts;

interface RequestBuilderInterface
{
    public function build(): array;
}
