<?php

namespace App\Providers;

use App\Contracts\Repositories\ArticleRepositoryInterface;
use App\Contracts\Repositories\AuthorRepositoryInterface;
use App\Contracts\Repositories\CategoryRepositoryInterface;
use App\Contracts\Repositories\SourceRepositoryInterface;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use App\Models\Source;
use App\Repositories\ArticleRepository;
use App\Repositories\AuthorRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\SourceRepository;
use App\Transformers\ArticleDtoTransformer;
use Illuminate\Support\ServiceProvider;

class NewsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleRepositoryInterface::class, function ($app) {
            return new ArticleRepository(
                new Article(),
                $app->make(ArticleDtoTransformer::class)
            );
        });

        $this->app->bind(ArticleDtoTransformer::class, function ($app) {
            return new ArticleDtoTransformer(
                $app->make(SourceRepository::class),
                $app->make(AuthorRepository::class),
                $app->make(CategoryRepository::class)
            );
        });

        $this->app->bind(SourceRepositoryInterface::class, fn() => new SourceRepository(new Source()));
        $this->app->bind(AuthorRepositoryInterface::class, fn() => new AuthorRepository(new Author()));
        $this->app->bind(CategoryRepositoryInterface::class, fn() => new CategoryRepository(new Category()));
    }
}
