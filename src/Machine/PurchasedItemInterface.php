<?php

namespace App\Machine;

/**
 * Interface PurchasedItemInterface
 *
 * @package App\Machine
 */
interface PurchasedItemInterface
{
//region SECTION: Getters/Setters
    /**
     * @return integer
     */
    public function getItemQuantity();

    /**
     * @return float
     */
    public function getTotalAmount();

    /**
     * Returns the change in this format:
     *
     * Coin Count
     * 0.01 0
     * 0.02 0
     * .... .....
     *
     * @return array
     */
    public function getChange();
//endregion Getters/Setters
}