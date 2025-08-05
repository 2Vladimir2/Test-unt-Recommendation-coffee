<?php

namespace App\Http\Controllers\Api;

use App\Enums\MoodEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\LanguageService;
use App\Services\MoodService;
use App\Services\RecommendationService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function recommend(Request $request, RecommendationService $recommendationService)
    {
        $data = $request->validate([
            'user_id' => 'nullable|integer',
            'mood' => 'nullable|string',
            'time_of_day' => 'nullable|string',
        ]);

        $user = $request->user();

        $recommendation = $recommendationService->recommend($user, $data);

        return response()->json([
            'recommendation' => $recommendation,
        ]);
    }
}
