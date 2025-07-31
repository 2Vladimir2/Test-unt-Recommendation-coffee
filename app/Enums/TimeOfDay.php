<?php

namespace App\Enums;

enum TimeOfDay: string
{
    case morning = 'morning';
    case afternoon = 'afternoon';
    case evening = 'evening';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
