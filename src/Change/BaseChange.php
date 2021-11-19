<?php

namespace App\Change;

class BaseChange extends AbstractCoinExchange
{
//region SECTION: Protected
    protected function getNext()
    {
        return new OneCoin($this);
    }
//endregion Protected
}