<?php
declare(strict_types=1);

namespace App;

use App\Bank\MoneyFactory;
use App\Bank\MoneyInterface;
use App\Bank\MultiCurrencyAccountFactory;
use App\Bank\MultiCurrencyAccountInterface;
use App\Bank\RatesConfigInterface;

class Bank implements BankInterface
{
    /**
    * @param RatesConfigInterface $ratesConfig
    * @param string $defaultCurrencyAccount
    */
    public function __construct(
        private RatesConfigInterface $ratesConfig,
        private string $defaultCurrencyAccount
    ) {
    }

    /**
     * @inheritdoc
     */
    public function createAccount(): MultiCurrencyAccountInterface
    {
        $account = MultiCurrencyAccountFactory::create($this);
        $account->addCurrencyAccount($this->defaultCurrencyAccount);

        return $account;
    }

    /**
     * @inheritdoc
     */
    public function getCurrencyRate(string $currencyFrom, string $currencyTo): float
    {
        return $this->ratesConfig->getCurrencyRate($currencyFrom, $currencyTo);
    }

    /**
     * @inheritdoc
     */
    public function setCurrencyRate(string $currencyFrom, string $currencyTo, float $rate): self
    {
        $this->ratesConfig->setCurrencyRate($currencyFrom, $currencyTo, $rate);

        return $this;
    }

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
    public function convertMoney(MoneyInterface $money, string $currencyCode): MoneyInterface
    {
        if ($money->getCurrencyCode() == $currencyCode) {
            return $money;
        }
        $rate = $this->ratesConfig->getCurrencyRate($money->getCurrencyCode(), $currencyCode);

        return MoneyFactory::create($currencyCode, $money->getAmount() * $rate);
    }
}
