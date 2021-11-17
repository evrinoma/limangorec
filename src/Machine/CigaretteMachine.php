<?php

namespace App\Machine;

use App\Change\IChange;

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

//region SECTION: Constructor
    /**
     * @var IChange
     */
    private $change;

    public function __construct(IChange $change)
    {
        $this->change = $change;
    }
//endregion Constructor

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
        $this->change->init($paidAmount - $totalAmount);

        return $this->change->next()->getChange();
    }
//endregion Private
}