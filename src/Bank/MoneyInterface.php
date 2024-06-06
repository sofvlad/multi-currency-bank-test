<?php
declare(strict_types=1);

namespace App\Bank;

use App\Enums\CurrencyTypes;

interface MoneyInterface
{
    /**
     * Get amount
     * 
     * @return float
     */
    public function getAmount(): float;

    /**
     * Get currency code
     * 
     * @return CurrencyTypes
     */
    public function getCurrencyCode(): CurrencyTypes;
}
