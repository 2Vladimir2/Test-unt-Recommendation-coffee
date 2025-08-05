<?php

use App\Http\Controllers\Api\RecommendationController;
use App\Http\Middleware\AuthenticateTestUser;
use App\Services\MoodService;
use App\Services\RecommendationService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use Illuminate\Support\Facades\Route;

Route::post('/recommend', [RecommendationController::class, 'recommend']);

Route::middleware([AuthenticateTestUser::class])->get('/coffee/recommendation', function () {
    $user = request()->user();
    $recommendationService = new RecommendationService(
        new MoodService,
        new TimeOfDayService,
        new UserPreferenceService
    );

    return ['recommendation' => $recommendationService->recommend($user)->value];
});
