<?php

namespace App\Services;

use App\Enums\CoffeeType;
use App\Enums\MoodEnum;
use App\Enums\TimeOfDay;
use App\Models\User;

class RecommendationService
{
    public function __construct(
        protected MoodService $moodService,
        protected TimeOfDayService $timeOfDayService,
        protected UserPreferenceService $userPreferenceService,
    ) {}

    public function recommend(User $user, array $data): CoffeeType
    {
        $mood = MoodEnum::tryFrom(mb_strtolower($data['mood'] ?? ''));

        if ($preferred = $this->userPreferenceService->getRecommendation($user)) {
            return $preferred;
        }

        if ($mood) {
            return $this->moodService->getRecommendation($user->mood);
        }

        if ($user->time_of_day instanceof TimeOfDay) {
            return $this->timeOfDayService->getRecommendation($user->time_of_day);
        }

        return CoffeeType::from(config('recommendations.default'));

    }
}
