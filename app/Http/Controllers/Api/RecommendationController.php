<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MoodService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use App\Services\RecommendationService;
use App\Models\User;
use App\Enums\Mood;

class  RecommendationController extends Controller
{
    public function recommend(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|integer',
            'mood' => 'nullable|string',
            'time_of_day' => 'nullable|string',
        ]);

        $mood = $data['mood'] ? Mood::tryFrom(mb_strtolower($data['mood'])) : null;

        $user = null;
        if (!empty($data['user_id'])) {
            $user = User::find($data['user_id']);
        }

        if (!$user) {
            $user = new User();
            $user->mood = $data['mood'] ?? null;
            $user->time_of_day = $data['time_of_day'] ?? null;
        }

        $recommendation = (new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        ))->recommend($user);

        return response()->json([
            'recommendation' => $recommendation
        ]);
    }
}
