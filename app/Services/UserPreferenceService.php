<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Collection;

class UserPreferenceService
{
    public function getRecommendation(User $user): Collection
    {
        return $user->preferred_coffies;
    }
}
