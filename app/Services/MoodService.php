<?php

namespace App\Services;

use App\Enums\Mood;
use App\Enums\CoffeeType;
class MoodService
{
    public function getRecommendation(?Mood $mood): CoffeeType
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


