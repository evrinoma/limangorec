<?php

namespace App\Machine;

use App\Exception\InsufficientFundException;
use App\Exception\NotEnoughException;

class PurchaseTransaction implements PurchaseTransactionInterface
{
//region SECTION: Fields
    /**
     * @var int
     */
    private $itemCount;

    /**
     * @var float
     */
    private $amount;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param $itemCount
     * @param $amount
     */
    public function __construct($itemCount, $amount)
    {
        $this->itemCount = $itemCount;
        $this->amount    = $amount;

        $this->validate();
    }
//endregion Constructor

//region SECTION: Private
    private function validate()
    {
        if ($this->amount <= 0) {
            throw new NotEnoughException();
        }

        if ($this->amount < $this->itemCount * CigaretteMachine::ITEM_PRICE) {
            throw new InsufficientFundException();
        }
    }
//endregion Private

//region SECTION: Getters/Setters
    public function getItemQuantity()
    {
        return $this->itemCount;
    }

    public function getPaidAmount()
    {
        return $this->amount;
    }
//endregion Getters/Setters
}