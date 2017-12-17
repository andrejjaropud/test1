<?php

namespace Components\Base;

/**
 * Class ErrorValidationException
 * @package Components\Base
 */
class ErrorValidationException extends \Exception
{
    private $errors = [];

    public function __construct($errors)
    {
        $this->errors = $errors;
    }

    public function getErrors()
    {
        $strReturn ="";

        foreach ($this->errors as $key => $errorMessage) {
            $strReturn .= $key . ":" . $errorMessage . "\n";
        }

        return nl2br($strReturn);
    }
} 