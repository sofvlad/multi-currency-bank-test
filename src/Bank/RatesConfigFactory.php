<?php
declare(strict_types=1);

namespace App\Bank;

class RatesConfigFactory
{
    /**
     * Create object
     *
     * @param array $data
     *
     * @return RatesConfigInterface
     */
    public static function create(array $data): RatesConfigInterface
    {
        return new RatesConfig($data);
    }
}
