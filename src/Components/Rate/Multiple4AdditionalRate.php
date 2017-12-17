<?php

namespace Components\Rate;

use \Components\Base\DataRegistry;

/**
 * Class Multiple4AdditionalRate
 * @package Components\Rate
 */
class Multiple4AdditionalRate extends FeatureRate
{
    public function cost()
    {
        $retValue = $this->rate->cost();
        $idRecord = DataRegistry::getId();

        if ($idRecord % 4 == 0) {
            $retValue = $this->rate->cost() + 2;
        }

        return $retValue;
    }
}