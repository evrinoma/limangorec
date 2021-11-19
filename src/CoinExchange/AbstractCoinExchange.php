<?php

namespace App\CoinExchange;

abstract class AbstractCoinExchange implements ICoinExchange
{
//region SECTION: Fields
    const VALUE     = 0;
    /**
     * @deprecated
     */
    const PRECISION = 1;
    protected $difference = 0;
    protected $change     = [];
    /**
     * @var ICoinExchange
     */
    protected $save;
    /**
     * @var ICoinExchange
     */
    private $base;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param ICoinExchange $base
     */
    public function __construct(ICoinExchange $base = null)
    {
        $this->base = $base;
        $this->save = ($base) ? $this->base->getSave() : null;
    }
//endregion Constructor

//region SECTION: Protected
    abstract protected function getNext();
//endregion Protected
    //abstract protected function getPrecision();

//region SECTION: Public
    public function calc()
    {
        $difference = $this->base->getDifference();
        ;
        /**
         * @TODO escape loop float operation here
         */
//        $coinCount  = 0;
//        while (bccomp($difference, $value, 2) >= 0) {
//            $coinCount++;
//            $difference -= $value;
//            $difference = round($difference, 2);
//        }
        $precision   = $this->calcPrecision();
        $value       = $this->getValue();
        $valueP      = $value * $precision;
        $differenceP = (float)bcmul($difference, $precision, 2);
        $coinCount   = (int)($differenceP / $valueP);
        $difference  = (float)bcsub($difference, bcmul($coinCount, $value, 2), 2);

        $this->setDifference($difference);
        $this->addChange($coinCount);

        $this->next();
    }

    /**
     * @param $coinCount
     */
    public function addChange($coinCount)
    {
        if ($coinCount > 0) {
            $this->save->change[] = [static::VALUE, $coinCount];
        }
    }

    public function next()
    {
        $next = $this->getNext();
        if ($next) {
            $next->calc();
        }

        return $this->getSave();
    }

    public function init($difference)
    {
        $this->setDifference($difference);
        $this->save = &$this;

        return $this;
    }
//endregion Public

//region SECTION: Private
    private function calcPrecision()
    {
        $explodeDigits   = explode('.', (string)static::VALUE);
        $precisionPow       = strlen((string)$explodeDigits[1]);

        return pow(10, $precisionPow);

//        return $this->getPrecision();
    }

    /**
     * @deprecated
     * @return int
     */
    private function getPrecision()
    {
        return static::PRECISION;
    }
//endregion Private

//region SECTION: Getters/Setters
    public function getValue()
    {
        return static::VALUE;
    }

    public function getDifference()
    {
        return $this->difference;
    }

    /**
     * @return array
     */
    public function getChange()
    {
        return $this->change;
    }

    /**
     * @return ICoinExchange
     */
    public function getSave()
    {
        return $this->save;
    }

    public function setDifference($difference)
    {
        $this->difference = $difference;
    }

    /**
     * @param array $change
     */
    public function setChange($change)
    {
        $this->change = $change;
    }

//endregion Getters/Setters
}