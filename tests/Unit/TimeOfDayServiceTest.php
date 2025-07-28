<?php

namespace Tests\Unit;

use App\Services\TimeOfDayService;
use PHPUnit\Framework\TestCase;

class TimeOfDayServiceTest extends TestCase
{
    public function test_it_recommends_based_on_morning()
    {
        $service = new TimeOfDayService();

        $this->assertEquals('Эспрессо', $service->getRecommendation('morning'));
    }

    public function test_it_recommends_based_on_afternoon()
    {
        $service = new TimeOfDayService();

        $this->assertEquals('Латте', $service->getRecommendation('afternoon'));
    }

    public function test_it_recommends_based_on_evening()
    {
        $service = new TimeOfDayService();

        $this->assertEquals('Безкофеиновый', $service->getRecommendation('evening'));
    }

    public function test_it_returns_default_for_unknown_time()
    {
        $service = new TimeOfDayService();

        $this->assertEquals('Американо', $service->getRecommendation('ночь'));
    }
}
