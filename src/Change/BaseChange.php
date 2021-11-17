<?php

namespace App\Change;

class BaseChange extends AbstractDecorateChange
{
//region SECTION: Protected
    protected function getNext()
    {
        return new OneCoin($this);
    }
//endregion Protected
}