<?php

namespace App\Change;

interface ICoinExchange
{
//region SECTION: Public
    public function next();
 //   public function getPrecision();
//endregion Public

//region SECTION: Getters/Setters
    /**
     * @return array
     */
    public function getChange();

    public function getValue();
//endregion Getters/Setters
}