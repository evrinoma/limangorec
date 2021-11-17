<?php

namespace App\Machine;

/**
 * Interface PurchasableItemInterface
 *
 * @package App\Machine
 */
interface PurchaseTransactionInterface
{
//region SECTION: Getters/Setters
    /**
     * @return integer
     */
    public function getItemQuantity();

    /**
     * @return float
     */
    public function getPaidAmount();
//endregion Getters/Setters
}