<?php
declare(strict_types=1);

namespace App\Bank;

use App\BankInterface;

class MultiCurrencyAccountFactory
{
    /**
     * Create object
     *
     * @param BankInterface $ratesConfig
     *
     * @return MultiCurrencyAccountInterface
     */
    public static function create(BankInterface $bank): MultiCurrencyAccountInterface
    {
        return new MultiCurrencyAccount($bank);
    }
}
