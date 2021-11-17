<?php

namespace App\Machine;

use App\Change\BaseChange;
use App\Change\HalfCoin;
use App\Change\OneCoin;

/**
 * Class CigaretteMachine
 *
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
//region SECTION: Fields
    const ITEM_PRICE = 4.99;
//endregion Fields

//region SECTION: Public


    /**
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction)
    {
        $paidAmount   = $purchaseTransaction->getPaidAmount();
        $itemQuantity = $purchaseTransaction->getItemQuantity();
        $totalAmount  = $itemQuantity * self::ITEM_PRICE;
        $change       = $this->calcChange($paidAmount, $totalAmount);

        return new PurchasedItem($itemQuantity, $totalAmount, $change);
    }
//endregion Public

//region SECTION: Private
    private function calcChange($paidAmount, $totalAmount)
    {
        $base = new BaseChange();
        $base->init($paidAmount - $totalAmount);

        return $base->next()->getChange();
    }
//endregion Private
}