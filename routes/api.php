<?php

use App\Http\Controllers\News\ArticleController;
use App\Http\Controllers\News\AuthorController;
use App\Http\Controllers\News\CategoryController;
use App\Http\Controllers\News\SourceController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::get('/articles', [ArticleController::class, 'index']);
    Route::get('/articles/{id}', [ArticleController::class, 'show']);

    Route::get('/sources', [SourceController::class, 'index']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/authors', [AuthorController::class, 'index']);
});
