<?php
declare(strict_types=1);

namespace App\Bank\Account;

use App\Enums\CurrencyTypes;

class CurrencyAccountFactory
{
    /**
     * Create object
     *
     * @param CurrencyTypes $currencyCode
     * @param float $balance
     *
     * @return CurrencyAccountInterface
     */
    public static function create(CurrencyTypes $currencyCode, float $balance = 0): CurrencyAccountInterface
    {
        return new CurrencyAccount($currencyCode, $balance);
    }
}
