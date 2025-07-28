<?php

namespace Tests\Unit;

use App\Models\User;
use App\Services\UserPreferenceService;
use PHPUnit\Framework\TestCase;

class UserPreferenceServiceTest extends TestCase
{
    public function test_it_returns_user_preference_if_exists()
    {
        $user = new class {
            public string $preferred_coffee = 'Капучино';
        };

        $service = new UserPreferenceService();

        $this->assertEquals('Капучино', $service->getRecommendation($user));
    }

    public function test_it_returns_null_if_no_preference()
    {
        $user = new class {
            // нет свойства preferred_coffee
        };

        $service = new UserPreferenceService();

        $this->assertNull($service->getRecommendation($user));
    }
}
