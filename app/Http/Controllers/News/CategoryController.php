<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\BaseController;
use App\Http\Requests\New\Content\CategoryRequest;
use App\Http\Resources\News\CategoryResource;
use App\Services\Content\CategoryService;
use Illuminate\Http\JsonResponse;

class CategoryController extends BaseController
{
    public function __construct(private readonly CategoryService $categoryService)
    {
    }

    public function index(CategoryRequest $request): JsonResponse
    {
        $articles = $this->categoryService->listPaginated($request);

        return $this->successResponse(CategoryResource::collection($articles));
    }
}
