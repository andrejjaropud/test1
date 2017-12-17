<?php

namespace Components\Rate;

use \Components\Base\DataRegistry;

/**
 * Class QuarterAdditionalRate
 * @package Components\Rate
 */
class QuarterAdditionalRate extends FeatureRate
{
    public function cost()
    {
        $idQuarter = DataRegistry::getQuarter();

        return $this->rate->cost() * $idQuarter;
    }
}
