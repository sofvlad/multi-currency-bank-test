<?php
declare(strict_types=1);

namespace App\Bank;

class MoneyFactory
{
    /**
     * Create object
     *
     * @param string $currencyCode
     * @param float $amount
     *
     * @return MoneyInterface
     */
    public static function create(string $currencyCode, float $amount = 0): MoneyInterface
    {
        return new Money($currencyCode, $amount);
    }
}
