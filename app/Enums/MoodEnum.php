<?php

namespace App\Enums;

enum MoodEnum: string
{
    case CHEERFUL = 'cheerful';
    case TIRED = 'tired';
    case SLEEPY = 'sleepy';
    case STRESS = 'stress';
    case CHEERY = 'cheery';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
