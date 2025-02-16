<?php

namespace App\Enums;

enum NewsProvider: string
{
    case NEWS_API = 'newsapi';
    case GUARDIAN = 'guardian';
    case NYT = 'nyt';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
