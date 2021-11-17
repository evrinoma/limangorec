<?php

namespace App\Change;

class HalfCoin extends AbstractDecorateChange
{
    const VALUE = 0.5;

    protected function getNext()
    {
        return new TenthCoin($this);;
    }
}