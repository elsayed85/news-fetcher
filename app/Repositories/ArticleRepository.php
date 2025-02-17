<?php

namespace App\Repositories;

use App\Adapters\Transformers\ArticleDtoTransformer;
use App\Contracts\Repositories\{ArticleRepositoryInterface};
use App\Dtos\ArticleDto;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArticleRepository extends BaseRepository implements ArticleRepositoryInterface
{
    public function __construct(
        Article                         $model,
        protected ArticleDtoTransformer $transformer
    )
    {
        parent::__construct($model);
    }

    public function store(ArticleDto $dto): Article
    {
        return DB::transaction(fn() => $this->createArticle($dto));
    }

    public function storeMultiple(array $dtos): array
    {
        return DB::transaction(function () use ($dtos) {
            $bulkInsertData = collect($dtos)
                ->map(fn($dto) => $this->transformer->transform($dto)->toArray())
                ->all();

            if ($bulkInsertData) {
                $this->upsert($bulkInsertData, ['url'], [
                    'title', 'description', 'content', 'image_url', 'published_at',
                    'source_id', 'author_id', 'category_id'
                ]);
            }

            return $this->findWhereIn('url', array_column($bulkInsertData, 'url'))->toArray();
        });
    }

    private function createArticle(ArticleDto $dto): Model
    {
        $dbDto = $this->transformer->transform($dto);
        return $this->firstOrCreate(['url' => $dbDto->url], $dbDto->toArray());
    }
}
