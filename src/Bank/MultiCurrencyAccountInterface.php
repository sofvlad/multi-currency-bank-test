<?php
declare(strict_types=1);

namespace App\Bank;

use App\Bank\Account\CurrencyAccountInterface;

interface MultiCurrencyAccountInterface
{
    /**
     * Get default currency code
     *
     * @param string $value
     *
     * @return self
     */
    public function setDefaultCurrencyCode(string $value): self;

    /**
     * Get default currency code
     *
     * @return string|null
     */
    public function getDefaultCurrencyCode(): ?string;

    /**
     * Add currency account
     *
     * @param string $currencyCode
     * @param float $initialBalance
     *
     * @return self
     */
    public function addCurrencyAccount(string $currencyCode, float $initialBalance = 0): self;

    /**
     * Remove currency account
     *
     * @param string $currencyCode
     *
     * @return self
     */
    public function removeCurrencyAccount(string $currencyCode): self;

    /**
     * Get supported accounts
     *
     * @return string[]
     */
    public function getSupportedAccounts(): array;

    /**
     * Get balance by currency code or default currency code if you not set currencyCode param
     *
     * @param string|null $currencyCode
     *
     * @return MoneyInterface
     */
    public function getBanalce(?string $currencyCode = null): MoneyInterface;

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
