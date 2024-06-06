<?php
declare(strict_types=1);

namespace App\Enums;

enum CurrencyTypes: string
{
    case RUB = 'RUB';
    case EUR = 'EUR';
    case USD = 'USD';
}
