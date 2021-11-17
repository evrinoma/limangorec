<?php

namespace App\Change;

interface IChange
{
    public function next();
    /**
     * @return array
     */
    public function getChange();

    public function getValue();
}