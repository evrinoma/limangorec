<?php

namespace App\CoinExchange\Nominal;

use App\CoinExchange\AbstractCoinExchange;

class TenthCoin extends AbstractCoinExchange
{
//region SECTION: Fields
    const VALUE = 0.1;
    const PRECISION = 10;
//endregion Fields

//region SECTION: Protected
    protected function getNext()
    {
        return new HundredthCoin($this);
    }
//endregion Protected
}