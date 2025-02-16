<?php

use App\Builders\GuardianRequestBuilder;
use App\Builders\NewsAPIRequestBuilder;
use App\Builders\NytRequestBuilder;
use App\Jobs\Guardian\FetchAndSaveJob;
use App\Services\Providers\GuardianService;
use App\Services\Providers\NewsAPIService;
use App\Services\Providers\NytService;
use Illuminate\Support\Facades\Route;


Route::get('/', function (\App\Services\Content\ArticleService $service) {

//    dispatch_sync(new FetchAndSaveJob(section: 'technology', fromDate: '2023-01-01', page: 1));

//    dd('done');
//    $requestBuilder = (new NytRequestBuilder())
//        ->setQuery('technology')
//        ->setDateRange('2023-01-01', '2023-12-31')
//        ->setPage(1);
//    $apiService = new NytService();
//    $articles = $apiService->fetchAndNormalizeArticles($requestBuilder);
//
//
    $requestBuilder = (new GuardianRequestBuilder())
//        ->setSection('technology')
//        ->setFromDate('2023-01-01')
        ->setPage(3);
    $apiService = new GuardianService();
    $articles = $apiService->fetchAndNormalizeArticles($requestBuilder);

    dd(
        $articles
    );

    $requestBuilder = (new NewsAPIRequestBuilder())
        ->setCategory('technology')
        ->setPage(1);

    $apiService = new NewsAPIService();
    $articles = $apiService->fetchAndNormalizeArticles($requestBuilder);
    $models = $service->storeMultipleArticles($articles);

    dd(
        $models
    );
});
