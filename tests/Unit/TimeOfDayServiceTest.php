<?php

namespace Tests\Unit;

use App\Services\TimeOfDayService;
use PHPUnit\Framework\TestCase;
use App\Enums\CoffeeType;
use App\Enums\TimeOfDay;


class TimeOfDayServiceTest extends TestCase
{
    public function test_it_recommends_based_on_morning()
    {
        $service = new TimeOfDayService();

        $this->assertEquals(CoffeeType::Эспрессо->value, $service->getRecommendation(TimeOfDay::morning->value));
    }

    public function test_it_recommends_based_on_afternoon()
    {
        $service = new TimeOfDayService();

        $this->assertEquals(CoffeeType::Латте->value, $service->getRecommendation(TimeOfDay::afternoon->value));
    }

    public function test_it_recommends_based_on_evening()
    {
        $service = new TimeOfDayService();

        $this->assertEquals(CoffeeType::Безкофеиновый->value, $service->getRecommendation(TimeOfDay::evening->value));
    }

    public function test_it_returns_default_for_unknown_time()
    {
        $service = new TimeOfDayService();

        $this->assertEquals(CoffeeType::Американо->value, $service->getRecommendation('ночь'));
    }
}
