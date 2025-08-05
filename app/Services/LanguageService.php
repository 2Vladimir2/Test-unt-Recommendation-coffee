<?php

namespace App\Services;

use App\Enums\CoffeeType;
use App\Enums\MoodEnum;
use App\Enums\TimeOfDay;

class LanguageService
{
    private function translateEnumValue(string $enumValue, string $group): string
    {
        return __("coffee.$group.$enumValue");
    }

    public function translateCoffee(CoffeeType $type): string
    {
        return $this->translateEnumValue($type->value, 'coffeeType');
    }

    public function translateMood(MoodEnum $mood): string
    {
        return $this->translateEnumValue($mood->value, 'moods');
    }

    public function translateTimeOfDay(TimeOfDay $time): string
    {
        return $this->translateEnumValue($time->value, 'timeOfDay');
    }
}
