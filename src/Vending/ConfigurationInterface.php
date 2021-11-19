<?php

namespace App\Vending;

use App\CoinExchange\CoinExchangeInterface;

interface ConfigurationInterface
{
    /**
     * @return CoinExchangeInterface
     */
    public function changeBlock();
}