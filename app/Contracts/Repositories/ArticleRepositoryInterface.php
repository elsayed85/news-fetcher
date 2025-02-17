<?php

namespace App\Contracts\Repositories;

use App\Dtos\ArticleDto;
use App\Models\Article;

interface ArticleRepositoryInterface extends BaseRepositoryInterface
{
    public function store(ArticleDto $dto): Article;
}
