<?php
declare(strict_types=1);

namespace App\Bank;

use App\Enums\CurrencyTypes;

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
    public function getCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo): float
    {
        $currencyFrom = $currencyFrom->value;
        $currencyTo = $currencyTo->value;
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
    public function setCurrencyRate(CurrencyTypes $currencyFrom, CurrencyTypes $currencyTo, float $rate): self
    {
        $currencyFrom = $currencyFrom->value;
        $currencyTo = $currencyTo->value;
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
}
