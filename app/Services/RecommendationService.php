<?php

namespace App\Services;

use App\Enums\CoffeeTypeEnum;
use App\Enums\MoodEnum;
use App\Enums\TimeOfDayEnum;
use App\Models\User;

class RecommendationService
{
    public function __construct(
        protected MoodService $moodService,
        protected TimeOfDayService $timeOfDayService,
        protected UserPreferenceService $userPreferenceService,
    ) {}

    public function recommend(User $user, array $data): CoffeeTypeEnum
    {
        $mood = MoodEnum::tryFrom(mb_strtolower($data['mood'] ?? ''));
        $timeOfDay = TimeOfDayEnum::tryFrom(mb_strtolower($data['tye_of_day'] ?? ''));

        if ($mood) {
            return $this->moodService->getRecommendation($mood);
        }

        if ($timeOfDay) {
            return $this->timeOfDayService->getRecommendation($timeOfDay);
        }

        if ($preferred = $this->userPreferenceService->getRecommendation($user)) {
            return CoffeeTypeEnum::tryFrom($preferred) ?? config('recommendations.default');
        }

        return CoffeeTypeEnum::tryFrom(config('recommendations.default'));

    }
}
