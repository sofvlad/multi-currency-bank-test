<?php
declare(strict_types=1);

namespace App\Bank;

interface MoneyInterface
{
    public function getAmount(): float;

    public function getCurrencyCode(): string;
}
