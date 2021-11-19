<?php

namespace App\Change;

class HalfCoin extends AbstractCoinExchange
{
//region SECTION: Fields
    const VALUE = 0.5;
//endregion Fields

//region SECTION: Protected
    protected function getNext()
    {
        return new TenthCoin($this);;
    }
//endregion Protected
}