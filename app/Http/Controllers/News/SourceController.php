<?php

namespace App\Http\Controllers\News;

use App\Http\Controllers\BaseController;
use App\Http\Requests\New\Content\SourceRequest;
use App\Http\Resources\News\SourceResource;
use App\Services\Content\SourceService;
use Illuminate\Http\JsonResponse;

class SourceController extends BaseController
{
    public function __construct(private readonly SourceService $sourceService)
    {
    }

    public function index(SourceRequest $request): JsonResponse
    {
        $articles = $this->sourceService->listPaginated($request);

        return $this->successResponse(SourceResource::collection($articles));
    }
}
