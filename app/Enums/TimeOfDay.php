<?php

namespace App\Enums;

enum TimeOfDay: string
{
    case MORNING = 'morning';
    case AFTERNOON = 'afternoon';
    case EVENING = 'evening';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
