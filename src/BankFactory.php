<?php
declare(strict_types=1);

namespace App;

use App\Bank\RatesConfigInterface;
use App\Bank\RatesInterface;

class BankFactory
{
    /**
     * Create object
     *
     * @param RatesConfigInterface $$ratesConfig
     * @param string $defaultCurrencyAccount
     *
     * @return BankInterface
     */
    public static function create(
        RatesConfigInterface $ratesConfig,
        string $defaultCurrencyAccount
    ): BankInterface {
        return new Bank($ratesConfig, $defaultCurrencyAccount);
    }
}
