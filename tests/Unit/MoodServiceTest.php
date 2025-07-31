<?php

namespace Tests\Unit;

use App\Services\MoodService;
use App\Enums\Mood;
use App\Enums\CoffeeType;
use Tests\TestCase;

class MoodServiceTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config()->set('recommendations.default', 'Американо');
        config()->set('recommendations.moods', [
            'веселый'   => 'Капучино',
            'уставший'  => 'Эспрессо',
            'сонный'    => 'Доппио',
            'стресс'    => 'Латте',
            'бодрый'    => 'Эспрессо',
        ]);
    }

    public function test_it_returns_coffee_for_known_moods()
    {
        $service = new MoodService();

        $this->assertEquals(CoffeeType::Капучино, $service->getRecommendation(Mood::веселый));
        $this->assertEquals(CoffeeType::Эспрессо, $service->getRecommendation(Mood::уставший));
    }

    public function test_it_returns_default_for_null_mood()
    {
        $service = new MoodService();

        $this->assertEquals(CoffeeType::Американо, $service->getRecommendation(null));
    }

    public function test_it_returns_default_for_unknown_mood()
    {
        $service = new MoodService();

        // эмулируем настроение, которого нет в конфиге
        config()->set('recommendations.moods', []); // очищаем карту настроений

        $this->assertEquals(CoffeeType::Американо, $service->getRecommendation(Mood::веселый));
    }
}
