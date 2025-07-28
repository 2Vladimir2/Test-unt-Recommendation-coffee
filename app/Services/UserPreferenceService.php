<?php

namespace App\Services;

class UserPreferenceService
{
    public function getRecommendation(object $user): ?string
    {
        return property_exists($user, 'preferred_coffee')
            ? $user->preferred_coffee
            : null;
    }
}
