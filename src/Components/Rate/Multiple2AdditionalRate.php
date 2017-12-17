<?php

namespace Components\Rate;

use Components\Base\DataRegistry;

/**
 * Class Multiple2AdditionalRate
 * @package Components\Rate
 */
class Multiple2AdditionalRate extends FeatureRate
{
    public function cost()
    {
        $retValue = $this->rate->cost();
        $idRecord = DataRegistry::getId();

        if ($idRecord % 2 == 0) {
            $retValue = $this->rate->cost() + 1;
        }

        return $retValue;
    }
}