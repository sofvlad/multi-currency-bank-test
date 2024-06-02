<?php
declare(strict_types=1);

namespace App\Bank;

class Money implements MoneyInterface
{
    private float $amount = 0;

    private string $currencyCode;

    public function __construct(
        string $currencyCode,
        float $amount = 0
    ) {
        $this->amount = $amount;
        $this->currencyCode = strtoupper($currencyCode);
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrencyCode(): string
    {
        return $this->currencyCode;
    }
}
