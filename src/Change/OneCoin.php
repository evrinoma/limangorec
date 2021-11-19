<?php

namespace App\Change;

class OneCoin extends AbstractCoinExchange
{
//region SECTION: Fields
    const VALUE = 1;
//endregion Fields

//region SECTION: Protected
    protected function getNext()
    {
        return new HalfCoin($this);
    }
//endregion Protected
}