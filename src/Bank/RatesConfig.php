<?php
declare(strict_types=1);

namespace App\Bank;

class RatesConfig implements RatesConfigInterface
{
    /**
     * @param array $ratesConfig
     */
    public function __construct(
        private array $data
    ) {
    }

    /**
     * @inheritdoc
     */
    public function getCurrencyRate(string $currencyFrom, string $currencyTo): float
    {
        $currencyFrom = strtoupper($currencyFrom);
        $currencyTo = strtoupper($currencyTo);
        if (empty($this->data[$currencyFrom])
            || empty($this->data[$currencyFrom][$currencyTo])
        ) {
            throw new \Exception(sprintf(
                'Currency rate (%s > %s) not configured.',
                $currencyFrom,
                $currencyTo
            ));
        }

        return $this->data[$currencyFrom][$currencyTo];
    }

    /**
     * @inheritdoc
     */
    public function setCurrencyRate(string $currencyFrom, string $currencyTo, float $rate): self
    {
        $currencyFrom = strtoupper($currencyFrom);
        $currencyTo = strtoupper($currencyTo);
        if (empty($this->data[$currencyFrom])) {
            $this->data[$currencyFrom] = [];
        }
        if (empty($this->data[$currencyFrom])) {
            $this->data[$currencyTo] = [];
        }
        $this->data[$currencyFrom][$currencyTo] = $rate;
        if ($rate > 1) {
            $this->data[$currencyTo][$currencyFrom] = 1 / $rate;
        } else if ($rate < 1) {
            $this->data[$currencyTo][$currencyFrom] = 1 * (1 / $rate);
        } else {
            $this->data[$currencyTo][$currencyFrom] = 1;
        }

        return $this;
    }

    /**
     * Convert money by currency code.
     *
     * If currency of money equal currencyCode param then this method return
     * the same money instance otherwise, it will create a new one with the converted data.
     *
     * @param MoneyInterface $money
     * @param string $convertCurrencyCode
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
