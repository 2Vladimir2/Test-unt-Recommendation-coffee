<?php

namespace App\Enums;

enum CoffeeTypeEnum: string
{
    case CAPPUCCINO = 'cappuccino';
    case ESPRESSO = 'espresso';
    case DOPPIO = 'doppio';
    case LATTE = 'latte';
    case AMERICANO = 'americano';
    case DECAFFEINATED = 'decaffeinated';

    public static function all(): array
    {
        return array_column(self::cases(), 'value');
    }
}
