<?php

namespace Components\Rate;

/**
 * Class CountryRate
 * @package Components\Rate
 */
class CountryRate implements Rate
{
    protected $countryName;

    public function __construct($countryName)
    {
        $this->countryName = $countryName;
    }

    public function cost()
    {
        switch ($this->countryName) {
            case 'Hungary' :
                return 2;
            case 'Germany' :
                return 3;
            case 'France' :
                return 4;
            case 'Russia' :
                return 5;
            case 'Ukraine' :
                return 6;
            case 'Bulgaria' :
                return 7;
            default :
                return 0;
        }
    }
}