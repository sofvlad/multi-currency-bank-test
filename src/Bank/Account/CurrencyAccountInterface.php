<?php
declare(strict_types=1);

namespace App\Bank\Account;

use App\Bank\Money;
use App\Bank\MoneyInterface;
use App\Enums\CurrencyTypes;

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
     * @return CurrencyTypes
    */
    public function getCurrencyCode(): CurrencyTypes;

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
     * @param MoneyInterface $money
     * 
     * @return self
     */
    public function withdraw(MoneyInterface $money): self;
}
