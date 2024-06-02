<?php
declare(strict_types=1);

namespace App\Bank;

use App\Bank\Account\CurrencyAccount;
use App\Bank\Account\CurrencyAccountFactory;
use App\Bank\Account\CurrencyAccountInterface;
use App\BankInterface;

class MultiCurrencyAccount implements MultiCurrencyAccountInterface
{
    /**
     * @var CurrencyAccount[] $accounts
     */
    private array $accounts = [];

    /**
     * @var string|null $defaultCurrencyCode
     */
    private ?string $defaultCurrencyCode = null;

    /**
     * @param BankInterface $bank
     */
    public function __construct(
        private BankInterface $bank
    ) {
    }

    /**
     * @inheritdoc
     */
    public function setDefaultCurrencyCode(string $value): self
    {
        $this->defaultCurrencyCode = strtoupper($value);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getDefaultCurrencyCode(): ?string
    {
        return $this->defaultCurrencyCode;
    }

    /**
     * Create currency account object
     *
     * @param string $currencyCode
     * @param float $initialBalance
     *
     * @return CurrencyAccountInterface
     */
    private function createCurrencyAccount(string $currencyCode, float $initialBalance = 0): CurrencyAccountInterface
    {
        return CurrencyAccountFactory::create($currencyCode, $initialBalance);
    }

    /**
     * Get currency account
     *
     * @param string $currencyCode
     *
     * @return CurrencyAccountInterface
     */
    private function getCurrencyAccount(string $currencyCode): CurrencyAccountInterface
    {
        $currencyCode = strtoupper($currencyCode);
        if (empty($this->accounts[$currencyCode])) {
            throw new \Exception(sprintf('%s currency account not exist', $currencyCode));
        }

        return $this->accounts[$currencyCode];
    }

    /**
     * @inheritdoc
     */
    public function addCurrencyAccount(string $currencyCode, float $initialBalance = 0): self
    {
        $currencyCode = strtoupper($currencyCode);
        $this->accounts[$currencyCode] = $this->createCurrencyAccount($currencyCode, $initialBalance);
        if (empty($this->getDefaultCurrencyCode())) {
            $this->setDefaultCurrencyCode($currencyCode);
        }

        return $this;
    }

    /**
     * Remove currency account
     *
     * @param string $currencyCode
     *
     * @return self
     * @throws \Exception
     */
    public function removeCurrencyAccount(string $currencyCode): self
    {
        $account = $this->getCurrencyAccount($currencyCode);
        $balance = $account->getBalance();
        $this->moveBalance($balance->getCurrencyCode(), $this->getDefaultCurrencyCode());
        unset($this->accounts[strtoupper($currencyCode)]);

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getSupportedAccounts(): array
    {
        return array_keys($this->accounts);
    }

    /**
     * @inheritdoc
     */
    public function getBanalce(?string $currencyCode = null): MoneyInterface
    {
        $currencyCode = $currencyCode ?: $this->getDefaultCurrencyCode();
        if (empty($currencyCode)) {
            throw new \Exception('Not set default currency code');
        }
        $totalAmount = 0;
        /** @var CurrencyAccountInterface $account */
        foreach ($this->accounts as $account) {
            $totalAmount += $this->bank->convertMoney($account->getBalance(), $currencyCode)->getAmount();
        }

        return MoneyFactory::create($currencyCode, $totalAmount);
    }

    /**
     * Move balance from one surrency account to second currency account
     *
     * @param string $currencyCodeFrom
     * @param string $currencyCodeTo
     *
     * @return self
     */
    private function moveBalance(string $currencyCodeFrom, string $currencyCodeTo): self
    {
        if ($currencyCodeFrom == $currencyCodeTo) {
            return $this;
        }
        $accountFrom = $this->getCurrencyAccount($currencyCodeFrom);
        $accountTo = $this->getCurrencyAccount($currencyCodeTo);

        $balance = $accountFrom->getBalance();
        if (!empty($balance->getAmount())) {
            $accountFrom->withdraw($balance);
            $accountTo->deposit(
                $this->bank->convertMoney($balance, $accountTo->getCurrencyCode())
            );
        }

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function deposit(MoneyInterface $money): self
    {
        $this->getCurrencyAccount($money->getCurrencyCode())->deposit($money);

        return $this;
    }

    /**
     * Deposit the money to account
     *
     * @param MoneyInterface $money
     *
     * @return self
     * @throws \Exception
     */
    public function withdraw(MoneyInterface $money): self
    {
        $this->getCurrencyAccount($money->getCurrencyCode())->withdraw($money);

        return $this;
    }
}
