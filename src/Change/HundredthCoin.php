<?php

namespace App\Change;

class HundredthCoin extends AbstractDecorateChange
{
    const VALUE = 0.01;

    protected function getNext()
    {
        return null;
    }
}