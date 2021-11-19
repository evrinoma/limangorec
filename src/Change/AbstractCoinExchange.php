<?php

namespace App\Change;

abstract class AbstractCoinExchange implements ICoinExchange
{
//region SECTION: Fields
    const VALUE = 0;
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

//region SECTION: Public
    /**
     * @TODO escape float operation here
     */
    public function calc()
    {
        $difference = $this->base->getDifference();
        $coinCount  = 0;
        $value      = $this->getValue();
        while (bccomp($difference, $value, 2) >= 0) {
            $coinCount++;
            $difference -= $value;
            $difference = round($difference, 2);
        }
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