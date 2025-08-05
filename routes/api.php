<?php

use App\Http\Controllers\Api\RecommendationController;
use App\Http\Middleware\FakeAuthenticate;
use Illuminate\Support\Facades\Route;

Route::post('/recommend', [RecommendationController::class, 'recommend'])
    ->middleware(FakeAuthenticate::class)
    ->name('recommend');
