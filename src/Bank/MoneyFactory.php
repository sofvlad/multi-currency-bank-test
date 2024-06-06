<?php
declare(strict_types=1);

namespace App\Bank;

use App\Enums\CurrencyTypes;

class MoneyFactory
{
    /**
     * Create object
     *
     * @param CurrencyTypes $currencyCode
     * @param float $amount
     *
     * @return MoneyInterface
     */
    public static function create(CurrencyTypes $currencyCode, float $amount = 0): MoneyInterface
    {
        return new Money($currencyCode, $amount);
    }
}
