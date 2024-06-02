<?php
declare(strict_types=1);

namespace App\Bank\Account;

class CurrencyAccountFactory
{
    /**
     * Create object
     *
     * @param string $currencyCode
     * @param float $balance
     *
     * @return CurrencyAccountInterface
     */
    public static function create(string $currencyCode, float $balance = 0): CurrencyAccountInterface
    {
        return new CurrencyAccount($currencyCode, $balance);
    }
}
