<?php

namespace App\Change;

abstract class AbstractDecorateChange implements IChange
{
//region SECTION: Fields
    const VALUE = 0;
    protected $difference = 0;
    protected $change     = [];
    /**
     * @var IChange
     */
    protected $save;
    /**
     * @var IChange
     */
    private $base;
//endregion Fields

//region SECTION: Constructor
    /**
     * @param IChange $base
     */
    public function __construct(IChange $base = null)
    {
        $this->base = $base;
        $this->save = ($base) ? $this->base->getSave() : null;
    }
//endregion Constructor

//region SECTION: Protected
    abstract protected function getNext();
//endregion Protected

//region SECTION: Public
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
     * @return IChange
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