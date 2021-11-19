<?php

namespace App\Change;

class TenthCoin extends AbstractCoinExchange
{
//region SECTION: Fields
    const VALUE = 0.1;
//endregion Fields

//region SECTION: Protected
    protected function getNext()
    {
        return new HundredthCoin($this);
    }
//endregion Protected
}