<?php

namespace App\Services;

use App\Enums\CoffeeType;
use App\Enums\MoodEnum;

class MoodService
{
    public function getRecommendation(?MoodEnum $mood): CoffeeType
    {
        if ($mood === null) {
            return CoffeeType::from(config('recommendations.default'));
        }

        // Получаем карту из конфига
        $moodsMap = config('recommendations.moods', []);
        // Ищем соответствие, если нет — возвращаем дефолт
        $recommendation = $moodsMap[$mood->value] ?? config('recommendations.default');

        return CoffeeType::from($recommendation);
    }
}
