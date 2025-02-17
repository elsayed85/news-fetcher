<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\BaseController;
use App\Http\Requests\New\Content\AuthorRequest;
use App\Http\Resources\News\AuthorResource;
use App\Services\Content\AuthorService;

class AuthorController extends BaseController
{
    public function __construct(private readonly AuthorService $categoryService)
    {
    }

    public function index(AuthorRequest $request)
    {
        $articles = $this->categoryService->listPaginated($request);

        return $this->successResponse(AuthorResource::collection($articles));
    }
}
