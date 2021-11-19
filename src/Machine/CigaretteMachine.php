<?php

namespace App\Machine;

use App\CoinExchange\ICoinExchange;

/**
 * Class CigaretteMachine
 *
 * @package App\Machine
 */
class CigaretteMachine implements MachineInterface
{
//region SECTION: Fields
    const ITEM_PRICE = 4.99;
    /**
     * @var ICoinExchange
     */
    private $change;
//endregion Fields

//region SECTION: Constructor
    public function __construct(ICoinExchange $change)
    {
        $this->change = $change;
    }
//endregion Constructor

//region SECTION: Public
    /**
     * @TODO should looks like machine it's not a calculator
     *
     * @param PurchaseTransactionInterface $purchaseTransaction
     *
     * @return PurchasedItemInterface
     */
    public function execute(PurchaseTransactionInterface $purchaseTransaction)
    {
        $paidAmount   = $purchaseTransaction->getPaidAmount();
        $itemQuantity = $purchaseTransaction->getItemQuantity();
        $totalAmount  = $itemQuantity * self::ITEM_PRICE;
        $change       = $this->getChange($paidAmount-$totalAmount);

        return new PurchasedItem($itemQuantity, $totalAmount, $change);
    }
//endregion Public

//region SECTION: Private
    private function getChange($change)
    {
        return $this->change->init($change)->next()->getChange();
    }
//endregion Private
}