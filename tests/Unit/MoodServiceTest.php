<?php

namespace Tests\Unit;

use App\Enums\CoffeeType;
use App\Enums\MoodEnum;
use App\Services\MoodService;
use Tests\TestCase;

class MoodServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('recommendations.default', 'americano');
        config()->set('recommendations.moods', [
            'cheerful' => 'cappuccino',
            'tired' => 'espresso',
            'sleepy' => 'doppio',
            'stress' => 'latte',
            'cheery' => 'americano',
        ]);
    }

    public function test_it_returns_coffee_for_known_moods()
    {
        $service = new MoodService;

        $this->assertEquals(CoffeeType::CAPPUCCINO, $service->getRecommendation(MoodEnum::CHEERFUL));
        $this->assertEquals(CoffeeType::ESPRESSO, $service->getRecommendation(MoodEnum::TIRED));
    }

    public function test_it_returns_default_for_null_mood()
    {
        $service = new MoodService;

        $this->assertEquals(CoffeeType::AMERICANO, $service->getRecommendation(null));
    }

    public function test_it_returns_default_for_unknown_mood()
    {
        $service = new MoodService;

        config()->set('recommendations.moods', []); // очищаем карту настроений

        $this->assertEquals(CoffeeType::AMERICANO, $service->getRecommendation(MoodEnum::CHEERFUL));
    }
}
