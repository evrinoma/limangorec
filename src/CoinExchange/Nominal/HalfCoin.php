<?php

namespace App\CoinExchange\Nominal;

use App\CoinExchange\AbstractCoinExchange;

class HalfCoin extends AbstractCoinExchange
{
//region SECTION: Fields
    const VALUE = 0.5;
    const PRECISION = 10;
//endregion Fields

//region SECTION: Protected
    protected function getNext()
    {
        return new TenthCoin($this);;
    }
//endregion Protected
}