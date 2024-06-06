<?php
declare(strict_types=1);

namespace App;

use App\Bank\MoneyFactory;
use App\Bank\MoneyInterface;
use App\Bank\MultiCurrencyAccountFactory;
use App\Bank\MultiCurrencyAccountInterface;
use App\Bank\RatesConfigInterface;
use App\Enums\CurrencyTypes;

class Bank implements BankInterface
{
    /**
    * @param RatesConfigInterface $ratesConfig
    * @param CurrencyTypes $defaultCurrencyAccount
    */
    public function __construct(
        private RatesConfigInterface $ratesConfig,
        private CurrencyTypes $defaultCurrencyAccount
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
    public function getCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo): float
    {
        return $this->ratesConfig->getCurrencyRate($currencyFrom, $currencyTo);
    }

    /**
     * @inheritdoc
     */
    public function setCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo, float $rate): self
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
     * @param CurrencyTypes $currencyCode
     *
     * @return MoneyInterface
     */
    public function convertMoney(MoneyInterface $money, CurrencyTypes $currencyCode): MoneyInterface
    {
        if ($money->getCurrencyCode() == $currencyCode) {
            return $money;
        }
        $rate = $this->ratesConfig->getCurrencyRate($money->getCurrencyCode(), $currencyCode);

        return MoneyFactory::create($currencyCode, $money->getAmount() * $rate);
    }
}
