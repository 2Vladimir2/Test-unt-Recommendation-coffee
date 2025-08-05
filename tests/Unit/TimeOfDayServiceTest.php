<?php

namespace Tests\Unit;

use App\Enums\CoffeeTypeEnum;
use App\Enums\TimeOfDayEnum;
use App\Services\TimeOfDayService;
use Tests\TestCase;

class TimeOfDayServiceTest extends TestCase
{
    public function test_it_recommends_based_on_morning()
    {
        $service = new TimeOfDayService;

        $this->assertEquals(CoffeeTypeEnum::ESPRESSO->value, $service->getRecommendation(TimeOfDayEnum::MORNING)->value);
    }

    public function test_it_recommends_based_on_afternoon()
    {
        $service = new TimeOfDayService;

        $this->assertEquals(CoffeeTypeEnum::LATTE->value, $service->getRecommendation(TimeOfDayEnum::AFTERNOON)->value);
    }

    public function test_it_recommends_based_on_evening()
    {
        $service = new TimeOfDayService;

        $this->assertEquals(CoffeeTypeEnum::DECAFFEINATED->value, $service->getRecommendation(TimeOfDayEnum::EVENING)->value);
    }
}
