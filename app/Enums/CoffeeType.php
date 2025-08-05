<?php

namespace App\Enums;

enum CoffeeType: string
{
    case CAPPUCCINO = 'cappuccino';
    case ESPRESSO = 'espresso';
    case DOPPIO = 'doppio';
    case LATTE = 'latte';
    case AMERICANO = 'americano';
    case DECAFFEINATED = 'decaffeinated';

}
