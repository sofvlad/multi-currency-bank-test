<?php
declare(strict_types=1);

namespace App\Bank;

use App\Enums\CurrencyTypes;

interface RatesConfigInterface
{
    /**
     * Get currency rate value
     *
     * @param CurrencyTypes $currencyFrom
     * @param CurrencyTypes $currencyTo
     *
     * @return float
     */
    public function getCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo): float;

    /**
     * Set currency rate value in both directions
     *
     * @param CurrencyTypes $currencyFrom
     * @param CurrencyTypes $currencyTo
     * @param float $rate
     *
     * @return self
     */
    public function setCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo, float $rate): self;
}
