<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\MoodService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use App\Services\RecommendationService;

class RecommendationController extends Controller
{
    public function recommend(Request $request)
    {
        $data = $request->validate([
            'user_id' => 'nullable|integer',
            'mood' => 'nullable|string',
            'time_of_day' => 'nullable|string',
        ]);

        $user = new class($data) {
            public ?int $id;
            public ?string $preferred_coffee = null;
            public ?string $mood;
            public ?string $time_of_day;

            public function __construct($data)
            {
                $this->id = $data['user_id'] ?? null;
                $this->mood = $data['mood'] ?? null;
                $this->time_of_day = $data['time_of_day'] ?? null;
            }
        };

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
