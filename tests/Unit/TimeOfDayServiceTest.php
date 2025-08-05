<?php

namespace Tests\Unit;

use App\Enums\CoffeeType;
use App\Enums\TimeOfDay;
use App\Services\TimeOfDayService;
use Tests\TestCase;

class TimeOfDayServiceTest extends TestCase
{
    public function test_it_recommends_based_on_morning()
    {
        $service = new TimeOfDayService;

        $this->assertEquals(CoffeeType::ESPRESSO->value, $service->getRecommendation(TimeOfDay::MORNING)->value);
    }

    public function test_it_recommends_based_on_afternoon()
    {
        $service = new TimeOfDayService;

        $this->assertEquals(CoffeeType::LATTE->value, $service->getRecommendation(TimeOfDay::AFTERNOON)->value);
    }

    public function test_it_recommends_based_on_evening()
    {
        $service = new TimeOfDayService;

        $this->assertEquals(CoffeeType::DECAFFEINATED->value, $service->getRecommendation(TimeOfDay::EVENING)->value);
    }
}
