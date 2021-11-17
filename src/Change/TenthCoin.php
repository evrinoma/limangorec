<?php

namespace App\Change;

class TenthCoin extends AbstractDecorateChange
{
    const VALUE = 0.1;

    protected function getNext()
    {
        return new HundredthCoin($this);
    }
}