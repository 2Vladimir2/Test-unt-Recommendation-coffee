<?php
use App\Http\Controllers\Api\RecommendationController;

Route::post('/recommend', [RecommendationController::class, 'recommend']);


