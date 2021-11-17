<?php

namespace App\Change;

interface IChange
{
//region SECTION: Public
    public function next();
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return array
     */
    public function getChange();

    public function getValue();
//endregion Getters/Setters
}