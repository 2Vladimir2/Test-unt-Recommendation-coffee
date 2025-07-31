<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\MoodService;
use App\Services\RecommendationService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use Tests\TestCase;
use App\Enums\Mood;
use App\Enums\CoffeeType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecommendationServiceTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('recommendations.moods', [
            'уставший' => 'Эспрессо',
            'бодрый' => 'Эспрессо',
        ]);

        config()->set('recommendations.default', 'Американо');
    }

    public function test_it_returns_user_preference_if_exists()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'preferred_coffee' => 'Эспрессо',
            'mood' => Mood::уставший->value,
        ]);

        $service = new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        );

        // Сравниваем с enum по значению
        $this->assertEquals(
            CoffeeType::from($user->preferred_coffee)->value,
            $service->recommend($user)->value
        );
    }

    public function test_it_returns_based_on_mood_if_no_preference()
    {
        $user = User::create([
            'name' => 'Test User 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'mood' => Mood::бодрый->value,
            // preferred_coffee не установлен
        ]);

        $service = new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        );

        $this->assertEquals(CoffeeType::Эспрессо->value, $service->recommend($user)->value);
    }
    public function test_it_returns_default_if_no_data()
    {
        $user = User::create([
            'name' => 'Test User 3',
            'email' => 'user3@example.com',
            'password' => bcrypt('password'),
            // mood и preferred_coffee не заданы
        ]);

        $service = new RecommendationService(
            new MoodService(),
            new TimeOfDayService(),
            new UserPreferenceService()
        );

        $this->assertEquals(CoffeeType::Американо->value, $service->recommend($user)->value);
    }
}
