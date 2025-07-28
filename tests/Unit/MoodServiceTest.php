<?php

namespace Tests\Unit;

use App\Services\MoodService;
use PHPUnit\Framework\TestCase;

class MoodServiceTest extends TestCase
{
    public function test_it_returns_coffee_for_known_moods()
    {
        $service = new MoodService();

        $this->assertEquals('Капучино', $service->getRecommendation('веселый'));
        $this->assertEquals('Эспрессо', $service->getRecommendation('уставший'));
    }

    public function test_it_returns_default_for_unknown_mood()
    {
        $service = new MoodService();

        $this->assertEquals('Американо', $service->getRecommendation('непонятное настроение'));
    }
}
