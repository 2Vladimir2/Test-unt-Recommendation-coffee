<?php
use App\Http\Controllers\Api\RecommendationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Services\RecommendationService;
use App\Http\Middleware\AuthenticateTestUser;
use App\Services\TimeOfDayService;
use App\Services\MoodService;
use App\Services\UserPreferenceService;

Route::post('/recommend', [RecommendationController::class, 'recommend']);

Route::middleware([AuthenticateTestUser::class])->get('/coffee/recommendation', function () {
    $user = request()->user();
    $recommendationService = new RecommendationService(
        new MoodService(),
        new TimeOfDayService(),
        new UserPreferenceService()
    );
    return ['recommendation' => $recommendationService->recommend($user)->value];
});



