<?php

namespace Tests\Unit;

use App\Enums\CoffeeType;
use App\Enums\MoodEnum;
use App\Models\User;
use App\Services\UserPreferenceService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserPreferenceServiceTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'preferred_coffee' => 'latte',
            'mood' => MoodEnum::CHEERFUL->value,
        ]);
    }

    public function test_it_returns_user_preference_if_exists()
    {
        $service = new UserPreferenceService;

        $this->assertEquals(CoffeeType::LATTE, $service->getRecommendation($this->user));
    }

    public function test_it_returns_null_if_no_preference()
    {
        $user = User::create([
            'name' => 'No Pref User',
            'email' => 'nopref@example.com',
            'password' => bcrypt('password'),
            'mood' => MoodEnum::CHEERFUL->value,
        ]);

        $service = new UserPreferenceService;

        $this->assertNull($service->getRecommendation($user));
    }
}
