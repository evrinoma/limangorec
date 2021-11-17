<?php

namespace App\Change;

class OneCoin extends AbstractDecorateChange
{
    const VALUE = 1;

    protected function getNext()
    {
        return new HalfCoin($this);
    }
}