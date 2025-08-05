<?php

namespace App\Services;

use App\Enums\CoffeeType;
use App\Enums\TimeOfDay;

class TimeOfDayService
{
    public function getRecommendation(?TimeOfDay $timeOfDay): CoffeeType
    {
        if ($timeOfDay === null) {
            return config('recommendations.default');
        }

        $timeMap = config('recommendations.time_of_day', []);

        $recommendation = $timeMap[$timeOfDay->value] ?? config('recommendations.default');

        return CoffeeType::from($recommendation);
    }
}
