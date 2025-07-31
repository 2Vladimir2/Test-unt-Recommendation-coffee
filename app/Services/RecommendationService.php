<?php

namespace App\Services;

use App\Enums\Mood;
use App\Enums\CoffeeType;
class RecommendationService
{
    public function __construct(
        protected MoodService $moodService,
        protected TimeOfDayService $timeOfDayService,
        protected UserPreferenceService $userPreferenceService,
    ) {}
    public function recommend(object $user): CoffeeType
    {
        // 1. Предпочтение пользователя
        $preferred = $this->userPreferenceService->getRecommendation($user);
        if ($preferred) {
            return CoffeeType::from($preferred);
        }

        // 2. Настроение
        if (isset($user->mood)) {
            // Преобразуем строку в enum Mood
            $moodEnum = Mood::tryFrom($user->mood);
            if ($moodEnum !== null) {
                // Получаем рекомендацию (ожидается enum CoffeeType)
                $moodCoffee = $this->moodService->getRecommendation($moodEnum);
                if ($moodCoffee !== null) {
                    return $moodCoffee; // Это уже enum CoffeeType
                }
            }
        }

        // 3. Дефолт
        return CoffeeType::Американо;
    }




}
