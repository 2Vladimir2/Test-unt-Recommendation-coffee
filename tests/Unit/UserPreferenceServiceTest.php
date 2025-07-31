<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Services\UserPreferenceService;
use Tests\TestCase;
use App\Enums\Mood;

class UserPreferenceServiceTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
            'preferred_coffee' => 'Латте',
            'mood' => Mood::веселый->value,
        ]);
    }

    public function test_it_returns_user_preference_if_exists()
    {
        $service = new UserPreferenceService();

        $this->assertEquals('Латте', $service->getRecommendation($this->user));
    }

    public function test_it_returns_null_if_no_preference()
    {
        $user = User::create([
            'name' => 'No Pref User',
            'email' => 'nopref@example.com',
            'password' => bcrypt('password'),
            'mood' => Mood::веселый->value,
        ]);

        $service = new UserPreferenceService();

        $this->assertNull($service->getRecommendation($user));
    }
}
