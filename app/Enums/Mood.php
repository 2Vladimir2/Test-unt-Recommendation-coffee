<?php

namespace App\Enums;

enum Mood: string
{
    case веселый = 'веселый';
    case уставший = 'уставший';
    case сонный = 'сонный';
    case стресс = 'стресс';
    case бодрый = 'бодрый';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}


