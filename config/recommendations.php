<?php

use App\Enums\CoffeeTypeEnum;
use App\Enums\MoodEnum;
use App\Enums\TimeOfDayEnum;

return [

    'moods' => [
        MoodEnum::CHEERFUL->value => CoffeeTypeEnum::CAPPUCCINO->value,
        MoodEnum::TIRED->value => CoffeeTypeEnum::ESPRESSO->value,
        MoodEnum::SLEEPY->value => CoffeeTypeEnum::DOPPIO->value,
        MoodEnum::STRESS->value => CoffeeTypeEnum::LATTE->value,
        MoodEnum::CHEERY->value => CoffeeTypeEnum::AMERICANO->value,
    ],

    'time_of_day' => [
        TimeOfDayEnum::MORNING->value => CoffeeTypeEnum::ESPRESSO->value,
        TimeOfDayEnum::AFTERNOON->value => CoffeeTypeEnum::LATTE->value,
        TimeOfDayEnum::EVENING->value => CoffeeTypeEnum::DECAFFEINATED->value,
    ],

    'default' => CoffeeTypeEnum::AMERICANO,

];
