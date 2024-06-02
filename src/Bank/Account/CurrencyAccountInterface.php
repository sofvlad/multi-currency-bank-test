<?php
declare(strict_types=1);

namespace App\Bank\Account;

use App\Bank\Money;
use App\Bank\MoneyInterface;

interface CurrencyAccountInterface
{
    /**
     * Get balance
     *
     * @return MoneyInterface
     */
    public function getBalance(): MoneyInterface;

    /**
     * Get currency code
     *
     * @return string
    */
    public function getCurrencyCode(): string;

    /**
     * Deposit the money to account
     *
     * @param flaot $money
     *
     * @return self
    */
    public function deposit(MoneyInterface $money): self;

    /**
     * Deposit the money to account
     *
     * @param Money $money
     MoneyInterface
     * @return self
     */
    public function withdraw(MoneyInterface $money): self;
}
