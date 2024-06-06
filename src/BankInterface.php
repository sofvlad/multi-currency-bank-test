<?php
declare(strict_types=1);

namespace App;

use App\Bank\MoneyInterface;
use App\Bank\MultiCurrencyAccountInterface;
use App\Enums\CurrencyTypes;

interface BankInterface
{
    /**
     * Create account
     *
     * @return MultiCurrencyAccountInterface
     */
    public function createAccount(): MultiCurrencyAccountInterface;

    /**
     * Get bank currency rate value
     *
     * @param CurrencyTypes $currencyFrom
     * @param CurrencyTypes $currencyTo
     *
     * @return float
     */
    public function getCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo): float;

    /**
     * Set bank currency rate value in both directions
     *
     * @param CurrencyTypes $currencyFrom
     * @param CurrencyTypes $currencyTo
     * @param float $rate
     *
     * @return self
     */
    public function setCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo, float $rate): self;

    /**
     * Convert money by currency code.
     *
     * If currency of money equal currencyCode param then this method return
     * the same money instance otherwise, it will create a new one with the converted data.
     *
     * @param MoneyInterface $money
     * @param string $currencyCode
     *
     * @return MoneyInterface
     */
    public function convertMoney(MoneyInterface $money, CurrencyTypes $currencyCode): MoneyInterface;
}
