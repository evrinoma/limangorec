<?php

namespace App\CoinExchange;

use App\CoinExchange\Nominal\OneCoin;

class BaseChange extends AbstractCoinExchange
{
//region SECTION: Protected
    protected function getNext()
    {
        return new OneCoin($this);
    }
//endregion Protected
}