<?php
declare(strict_types=1);

namespace App\Bank;

use App\Enums\CurrencyTypes;

interface MultiCurrencyAccountInterface
{
    /**
     * Get default currency code
     *
     * @param CurrencyTypes $value
     *
     * @return self
     */
    public function setDefaultCurrencyCode(CurrencyTypes $value): self;

    /**
     * Get default currency code
     *
     * @return CurrencyTypes|null
     */
    public function getDefaultCurrencyCode(): ?CurrencyTypes;

    /**
     * Add currency account
     *
     * @param CurrencyTypes $currencyCode
     * @param float $initialBalance
     *
     * @return self
     */
    public function addCurrencyAccount(CurrencyTypes $currencyCode, float $initialBalance = 0): self;

    /**
     * Remove currency account
     *
     * @param CurrencyTypes $currencyCode
     *
     * @return self
     */
    public function removeCurrencyAccount(CurrencyTypes $currencyCode): self;

    /**
     * Get supported accounts
     *
     * @return CurrencyTypes[]
     */
    public function getSupportedAccounts(): array;

    /**
     * Get balance by currency code or default currency code if you not set currencyCode param
     *
     * @param CurrencyTypes|null $currencyCode
     *
     * @return MoneyInterface
     */
    public function getBanalce(?CurrencyTypes $currencyCode = null): MoneyInterface;

    /**
     * Deposit the money to account
     *
     * @param MoneyInterface $money
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
