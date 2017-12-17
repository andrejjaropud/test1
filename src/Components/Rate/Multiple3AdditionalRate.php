<?php

namespace Components\Rate;

use \Components\Base\DataRegistry;

/**
 * Class Multiple3AdditionalRate
 * @package Components\Rate
 */
class Multiple3AdditionalRate extends FeatureRate
{
    public function cost()
    {
        $retValue = $this->rate->cost();
        $idRecord = DataRegistry::getId();

        if ($idRecord % 3 == 0) {
            $retValue = $this->rate->cost() + 1;
        }

        return $retValue;
    }
}