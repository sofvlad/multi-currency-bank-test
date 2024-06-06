<?php
declare(strict_types=1);

namespace App\Bank\Account;

use App\Bank\MoneyFactory;
use App\Bank\MoneyInterface;
use App\Enums\CurrencyTypes;

class CurrencyAccount implements CurrencyAccountInterface
{
    public function __construct(
        private CurrencyTypes $currencyCode,
        private float $balance = 0
    ) {
    }

    /**
     * @inheritdoc
     */
    public function getBalance(): MoneyInterface
    {
        return MoneyFactory::create($this->currencyCode, $this->balance);
    }

    /**
     * @inheritdoc
     */
    public function getCurrencyCode(): CurrencyTypes
    {
        return $this->currencyCode;
    }

    /**
     * @inheritdoc
     */
    public function deposit(MoneyInterface $money): self
    {
        if ($money->getCurrencyCode() != $this->currencyCode) {
            throw new \Exception('Currency code is incorrect.');
        }
        $this->balance += $money->getAmount();

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
        if ($money->getCurrencyCode() != $this->currencyCode) {
            throw new \Exception('Currency code is incorrect.');
        }
        if ($money->getAmount() > $this->balance) {
            throw new \Exception('Insufficient funds.');
        }
        $this->balance -= $money->getAmount();

        return $this;
    }
}
