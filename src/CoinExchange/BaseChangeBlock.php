<?php

namespace App\CoinExchange;

use App\CoinExchange\Nominal\OneCoin;

class BaseChangeBlock extends AbstractCoinExchange
{
//region SECTION: Protected
    protected function getNext()
    {
        return new OneCoin($this);
    }
//endregion Protected
}