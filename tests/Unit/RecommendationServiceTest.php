<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\MoodService;
use App\Services\RecommendationService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use PHPUnit\Framework\TestCase;

class RecommendationServiceTest extends TestCase
{
    public function test_it_returns_user_preference_if_exists()
    {
        $user = new class {
            public string $preferred_coffee = 'Флэт Уайт';
            public string $mood = 'спокойное';
        };

        $service = new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        );

        $this->assertEquals('Флэт Уайт', $service->recommend($user));
    }

    public function test_it_returns_based_on_mood_if_no_preference()
    {
        $user = new class {
            public string $mood = 'бодрый';
        };

        $service = new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        );

        $this->assertEquals('Эспрессо', $service->recommend($user));
    }

    public function test_it_returns_default_if_no_data()
    {
        $user = new class {}; // вообще без данных

        $service = new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        );

        $this->assertEquals('Американо', $service->recommend($user));
    }
}
