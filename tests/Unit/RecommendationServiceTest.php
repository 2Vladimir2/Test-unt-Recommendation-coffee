<?php

namespace Tests\Unit;

use App\Enums\CoffeeTypeEnum;
use App\Enums\MoodEnum;
use App\Models\User;
use App\Services\MoodService;
use App\Services\RecommendationService;
use App\Services\TimeOfDayService;
use App\Services\UserPreferenceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RecommendationServiceTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config()->set('recommendations.moods', [
            'tired' => 'espresso',
            'cheery' => 'espresso',
        ]);

        config()->set('recommendations.default', 'americano');
    }

    public function test_it_returns_user_preference_if_exists()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user1@example.com',
            'password' => bcrypt('password'),
            'preferred_coffee' => CoffeeTypeEnum::ESPRESSO->value,
            'mood' => MoodEnum::TIRED->value,
        ]);

        $service = new RecommendationService(
            new MoodService,
            new TimeOfDayService,
            new UserPreferenceService
        );

        // Сравниваем с enum по значению
        $this->assertEquals(
            $user->preferred_coffee->value,
            $service->recommend($user)->value
        );
    }

    public function test_it_returns_based_on_mood_if_no_preference()
    {
        $user = User::create([
            'name' => 'Test User 2',
            'email' => 'user2@example.com',
            'password' => bcrypt('password'),
            'mood' => MoodEnum::CHEERY->value,
            // preferred_coffee не установлен
        ]);

        $service = new RecommendationService(
            new MoodService,
            new TimeOfDayService,
            new UserPreferenceService
        );

        $this->assertEquals(CoffeeTypeEnum::ESPRESSO->value, $service->recommend($user)->value);
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
            new MoodService,
            new TimeOfDayService,
            new UserPreferenceService
        );

        $this->assertEquals(CoffeeTypeEnum::AMERICANO->value, $service->recommend($user)->value);
    }
}
