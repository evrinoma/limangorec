<?php

namespace App\Change;

class BaseChange extends AbstractDecorateChange
{
    protected function getNext()
    {
        return new OneCoin($this);
    }
}