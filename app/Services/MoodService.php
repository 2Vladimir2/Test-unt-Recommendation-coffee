<?php

namespace App\Services;

use App\Enums\CoffeeTypeEnum;
use App\Enums\MoodEnum;

class MoodService
{
    public function getRecommendation(?MoodEnum $mood): CoffeeTypeEnum
    {
        if ($mood === null) {
            return CoffeeTypeEnum::from(config('recommendations.default'));
        }

        // Get map from config
        $moodsMap = config('recommendations.moods', []);
        // Look for a match, if not - return default
        $recommendation = $moodsMap[$mood->value] ?? config('recommendations.default');

        return CoffeeTypeEnum::tryFrom($recommendation) ?? CoffeeTypeEnum::from(config('recommendations.default'));
    }
}
