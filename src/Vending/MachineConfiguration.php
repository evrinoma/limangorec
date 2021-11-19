<?php

namespace App\Vending;

use App\CoinExchange\CoinExchangeInterface;

class MachineConfiguration implements ConfigurationInterface
{
    /**
     * @var CoinExchangeInterface
     */
    private $changeBlock;

    public function __construct(CoinExchangeInterface $changeBlock)
    {
        $this->changeBlock = $changeBlock;
    }

    /**
     * @return CoinExchangeInterface
     */
    public function changeBlock()
    {
        return $this->changeBlock;
    }
}