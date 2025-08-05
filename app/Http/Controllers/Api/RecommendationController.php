<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Recommendation\RecommendationRequest;
use App\Services\LanguageService;
use App\Services\RecommendationService;

class RecommendationController extends Controller
{
    public function recommend(RecommendationRequest $request, RecommendationService $recommendationService, LanguageService $languageService)
    {
        $user = $request->user();

        $recommendation = $recommendationService->recommend($user, $request->all());

        return response()->json([
            'recommendation' => $languageService->translateCoffee($recommendation),
        ]);
    }
}
