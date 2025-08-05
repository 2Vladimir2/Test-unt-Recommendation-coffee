<?php

use App\Enums\CoffeeType;
use App\Enums\MoodEnum;
use App\Enums\TimeOfDay;

return [

    'moods' => [
        MoodEnum::CHEERFUL->value => CoffeeType::CAPPUCCINO->value,
        MoodEnum::TIRED->value => CoffeeType::ESPRESSO->value,
        MoodEnum::SLEEPY->value => CoffeeType::DOPPIO->value,
        MoodEnum::STRESS->value => CoffeeType::LATTE->value,
        MoodEnum::CHEERY->value => CoffeeType::AMERICANO->value,
    ],

    'time_of_day' => [
        TimeOfDay::MORNING->value => CoffeeType::ESPRESSO->value,
        TimeOfDay::AFTERNOON->value => CoffeeType::LATTE->value,
        TimeOfDay::EVENING->value => CoffeeType::DECAFFEINATED->value,
    ],

    'default' => CoffeeType::AMERICANO,

];
