<?php

namespace App\Change;

class HundredthCoin extends AbstractDecorateChange
{
//region SECTION: Fields
    const VALUE = 0.01;
//endregion Fields

//region SECTION: Protected
    protected function getNext()
    {
        return null;
    }
//endregion Protected
}