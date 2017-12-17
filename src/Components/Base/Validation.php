<?php

namespace Components\Base;

/**
 * Data valdator
 *
 * Class Validation
 * @package Components\Base
 */
class Validation
{

    /**
     * List of constraints
     *
     * @var array
     */
    protected $rules = [
        'username' => 'isNoEmpty',
        'password' => 'passwordmatchValidate',
        'firstname' => 'isNoEmpty',
        'lastname' => 'isNoEmpty',
        'countryname' => 'isNoEmpty',
        'email' => 'emailValidate',
        'zip' => 'zipValidate',
        'dt' => 'registrationDatetimeValidate'
    ];

    /**
     * List of customized messages
     *
     * @var array
     */
    protected $messages = [
        'username' => 'Username is empty',
        'password' => 'Password should be min 6 char and contains: small and big letters, numbers, special symbols',
        'firstname' => 'Firstname is empty',
        'lastname' => 'Lastname is empty',
        'countryname' => 'Country is incorrect',
        'email' => 'Email is not valid',
        'zip' => 'Zip is incorrect',
        'dt' => 'Date of registration is not valid'
    ];

    /**
     * List of returned errors in case of a failing assertion
     *
     * @var array
     */
    protected $errors = [];

    /**
     * @var Validation
     */
    private static $instance;

    /**
     * @return Validation
     */
    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Run validation
     *
     * @param array $data Data for validation
     *
     * @return void
     */
    public function run(array $data)
    {
        $this->cleanError();

        foreach ($this->rules as $key => $value) {
            if (isset($data[$key])) {
                if (!$this->$value($data[$key])) {
                    $this->setError($key);
                }
            }
        }
    }

    /**
     * Verify if errors exist
     *
     * @return boolean
     */
    public function isErrors()
    {
        if (count($this->errors) > 0) {
            return true;
        }

        return false;
    }

    /**
     * Validate no empty value
     *
     * @param mixed $match Value
     *
     * @return boolean
     */
    protected function isNoEmpty($match)
    {
        if (empty($match) === false) {
            return true;
        }

        return false;
    }

    /**
     * Email validator
     *
     * @param string $match email
     *
     * @return boolean
     */
    protected function emailValidate($match)
    {
        $check = filter_var($match, FILTER_VALIDATE_EMAIL);
        if ($check) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validator for password
     * The password should contain  lowercase letters,  uppercase letters,  numbers, special symbols
     * and should be at least 6 characters long.
     *
     * @param string $strPassword Password
     *
     * @return boolean
     */
    protected function passwordmatchValidate($strPassword)
    {
        $regEx = "/^(?=^.{6,}$)((?=.*[A-Za-z0-9])(?=.*[A-Z])(?=.*[a-z]))(?=.*[!@#\$%\^\&*\)\(+=._-])^.*$/";

        if (preg_match($regEx, $strPassword)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validator for postcode
     * The zipcode should contain  5 digits .
     *
     * @param string $zip Zip
     *
     * @return boolean
     */
    protected function zipValidate($zip)
    {
        $regEx = "/^\d{5}$/";

        if (preg_match($regEx, $zip)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validate
     *
     * @param string $dateRegistration Date of registration
     * @param string $startDate        Start of range
     * @param string $endDate          End of range
     *
     * @return boolean
     */
    protected function registrationDatetimeValidate (
        $dateRegistration,
        $startDate = '2016-01-01 00:00:00',
        $endDate = '2016-12-31 23:59:59'
    ) {
        // Convert to timestamp
        $startTs = strtotime($startDate);
        $endTs = strtotime($endDate);
        $userTs = strtotime($dateRegistration);

        // Check that user date is between start & end
        return (($userTs >= $startTs) && ($userTs <= $endTs));
    }

    /**
     * Set error
     *
     * @param string $key key
     *
     * @return void
     */
    protected function setError($key)
    {
        $this->errors[$key] = $this->messages[$key];
    }

    /**
     * get array of errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * Clean error array
     *
     * @return void
     */
    protected function cleanError()
    {
        unset($this->errors);
        $this->errors = [];
    }
} 