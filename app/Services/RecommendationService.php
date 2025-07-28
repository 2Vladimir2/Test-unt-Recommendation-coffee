<?php

namespace App\Services;

class RecommendationService
{
    public function __construct(
        protected MoodService $moodService,
        protected TimeOfDayService $timeOfDayService,
        protected UserPreferenceService $userPreferenceService,
    ) {}

    public function recommend(object $user): string
    {
        // 1. Предпочтение пользователя
        $preferred = $this->userPreferenceService->getRecommendation($user);
        if ($preferred) {
            return $preferred;
        }

        // 2. Настроение
        if (isset($user->mood)) {
            $moodCoffee = $this->moodService->getRecommendation($user->mood);
            if ($moodCoffee) {
                return $moodCoffee;
            }
        }

        // 3. Дефолт
        return 'Американо';
    }

}
