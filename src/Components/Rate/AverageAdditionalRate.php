<?php

namespace Components\Rate;

use \Components\Base\DataRegistry;

/**
 * Class AverageAdditionalRate
 * @package Components\Rate
 */
class AverageAdditionalRate extends FeatureRate
{
    public function cost()
    {
        $averageValue = DataRegistry::getAverage();

        if ($this->rate->cost() > $averageValue) {
            return $this->rate->cost() - 5;
        }

        return $this->rate->cost();
    }
}
