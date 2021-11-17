<?php

namespace App\Machine;

class PurchasedItem implements PurchasedItemInterface
{
//region SECTION: Fields
    private $itemQuantity;

    private $totalAmount;

    private $change;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param $itemQuantity
     * @param $totalAmount
     * @param $change
     */
    public function __construct($itemQuantity, $totalAmount, $change)
    {
        $this->itemQuantity = $itemQuantity;
        $this->totalAmount  = $totalAmount;
        $this->change       = $change;
    }
//endregion Constructor

//region SECTION: Getters/Setters
    public function getItemQuantity()
    {
        return $this->itemQuantity;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function getChange()
    {
        return $this->change;
    }
//endregion Getters/Setters
}