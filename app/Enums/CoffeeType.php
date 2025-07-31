<?php

namespace App\Enums;

enum CoffeeType: string
{
    case Капучино = 'Капучино';
    case  Эспрессо = 'Эспрессо';
    case Доппио = 'Доппио';
    case Латте = 'Латте';
    case Американо = 'Американо';
    case Безкофеиновый = 'Безкофеиновый';

}
