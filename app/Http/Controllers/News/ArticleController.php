<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\BaseController;
use App\Http\Resources\News\ArticleResource;
use App\Services\Content\ArticleService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ArticleController extends BaseController
{
    public function __construct(private readonly ArticleService $articleService)
    {
    }

    public function index(Request $request): JsonResponse
    {
        $articles = $this->articleService->listPaginated($request);
        return $this->successResponse(ArticleResource::collection($articles));
    }

    public function show(int $id): JsonResponse
    {
        $article = $this->articleService->show($id);

        return $article
            ? $this->successResponse((new ArticleResource($article))->withContent())
            : $this->errorResponse('Article not found', 404);
    }
}
