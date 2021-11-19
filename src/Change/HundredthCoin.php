<?php

namespace App\Change;

class HundredthCoin extends AbstractCoinExchange
{
//region SECTION: Fields
    const VALUE = 0.01;
    const PRECISION = 100;
//endregion Fields

//region SECTION: Protected
    protected function getNext()
    {
        return null;
    }
//endregion Protected
}