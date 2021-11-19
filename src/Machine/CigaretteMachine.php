<?php

namespace App\Machine;

use App\Vending\ConfigurationInterface;

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
     * @var ConfigurationInterface
     */
    private $configuration;
//endregion Fields

//region SECTION: Constructor
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;
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
        $change       = $this->configuration->changeBlock()->init($paidAmount - $totalAmount)->next()->getChange();

        return new PurchasedItem($itemQuantity, $totalAmount, $change);
    }
//endregion Public
}