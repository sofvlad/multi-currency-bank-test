<?php
declare(strict_types=1);

namespace App\Bank;

interface RatesConfigInterface
{
    /**
     * Get currency rate value
     *
     * @param string $currencyFrom
     * @param string $currencyTo
     *
     * @return float
     */
    public function getCurrencyRate(string $currencyFrom, string $currencyTo): float;

    /**
     * Set currency rate value in both directions
     *
     * @param string $currencyFrom
     * @param string $currencyTo
     * @param float $rate
     *
     * @return self
     */
    public function setCurrencyRate(string $currencyFrom, string $currencyTo, float $rate): self;
}
