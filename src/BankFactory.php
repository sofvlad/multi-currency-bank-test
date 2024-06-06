<?php
declare(strict_types=1);

namespace App;

use App\Bank\RatesConfigInterface;
use App\Enums\CurrencyTypes;

class BankFactory
{
    /**
     * Create object
     *
     * @param RatesConfigInterface $$ratesConfig
     * @param CurrencyTypes $defaultCurrencyAccount
     *
     * @return BankInterface
     */
    public static function create(
        RatesConfigInterface $ratesConfig,
        CurrencyTypes $defaultCurrencyAccount
    ): BankInterface {
        return new Bank($ratesConfig, $defaultCurrencyAccount);
    }
}
