<?php

namespace Components\Rate;

/**
 * Class FeatureRate
 * @package Components\Rate
 */
abstract class FeatureRate implements Rate
{
    protected $rate;

    function __construct(Rate $rate)
    {
        $this->rate = $rate;
    }

    abstract function cost();
}