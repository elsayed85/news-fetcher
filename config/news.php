<?php


use App\Enums\NewsProvider;

return [
    'providers' => [
        NewsProvider::NEWS_API->value => [
            'base_url' => env('NEWSAPI_BASE_URL', 'https://newsapi.org/v2'),
            'api_key' => env('NEWS_API_KEY'),
            'api_key_param' => env('NEWS_API_KEY_PARM', 'apiKey'),

            'endpoints' => [
                'news' => env('NEWSAPI_NEWS_ENDPOINT', 'top-headlines'),
            ],

            'timeout' => env('NEWSAPI_TIMEOUT', 10),
            'retry' => [
                'times' => env('NEWSAPI_RETRY_TIMES', 2),
                'sleep' => env('NEWSAPI_RETRY_SLEEP', 0),
            ],
        ],

        NewsProvider::GUARDIAN->value => [
            'base_url' => env('GUARDIAN_BASE_URL', 'https://content.guardianapis.com'),
            'api_key' => env('GUARDIAN_API_KEY'),
            'api_key_param' => env('NEWS_API_KEY_PARM', 'api-key'),
            'endpoints' => [
                'news' => env('GUARDIAN_NEWS_ENDPOINT', 'search'),
            ],

            'timeout' => env('GUARDIAN_TIMEOUT', 10),
            'retry' => [
                'times' => env('GUARDIAN_RETRY_TIMES', 2),
                'sleep' => env('GUARDIAN_RETRY_SLEEP', 0),
            ],
        ],

        NewsProvider::NYT->value => [
            'base_url' => env('NYTIMES_BASE_URL', 'https://api.nytimes.com'),
            'api_key' => env('NYTIMES_API_KEY'),
            'api_key_param' => env('NEWS_API_KEY_PARM', 'api-key'),
            'endpoints' => [
                'news' => env('NYTIMES_NEWS_ENDPOINT', 'svc/search/v2/articlesearch.json'),
            ],

            'timeout' => env('NYTIMES_TIMEOUT', 10),
            'retry' => [
                'times' => env('NYTIMES_RETRY_TIMES', 2),
                'sleep' => env('NYTIMES_RETRY_SLEEP', 0),
            ],
        ],
    ]
];
