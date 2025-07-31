<?php

namespace App\Services;

class UserPreferenceService
{
    public function getRecommendation(object $user): ?string
    {
        return $user->preferred_coffee ?? null;
    }
}
