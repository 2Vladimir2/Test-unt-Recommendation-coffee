<?php

namespace App\Services;

use App\Enums\CoffeeTypeEnum;
use App\Enums\TimeOfDayEnum;

class TimeOfDayService
{
    public function getRecommendation(?TimeOfDayEnum $timeOfDay): CoffeeTypeEnum
    {
        if ($timeOfDay === null) {
            return config('recommendations.default');
        }

        $timeMap = config('recommendations.time_of_day', []);

        $recommendation = $timeMap[$timeOfDay->value] ?? config('recommendations.default');

        return CoffeeTypeEnum::from($recommendation);
    }
}
