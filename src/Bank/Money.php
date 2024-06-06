<?php
declare(strict_types=1);

namespace App\Bank;

use App\Enums\CurrencyTypes;

class Money implements MoneyInterface
{
    private float $amount = 0;

    /**
     * @param CurrencyTypes $currencyCode
     * @param float $amount
     */
    public function __construct(
        private CurrencyTypes $currencyCode,
        float $amount = 0
    ) {
        if ($amount < 0) {
            throw new \Exception('Amount of money must be positive');
        }
        $this->amount = $amount;
    }

    /**
     * @inheritdoc
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @inheritdoc
     */
    public function getCurrencyCode(): CurrencyTypes
    {
        return $this->currencyCode;
    }
}
