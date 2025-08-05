<?php

namespace App\Services;

use App\Enums\CoffeeType;

class UserPreferenceService
{
    public function getRecommendation(object $user): ?CoffeeType
    {
        if ($user->preferred_coffee instanceof CoffeeType) {
            return $user->preferred_coffee;
        }

        try {
            return CoffeeType::from($user->preferred_coffee);
        } catch (\ValueError $e) {
            return null;
        }
    }
}
