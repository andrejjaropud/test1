<?php

namespace Model;

/**
 * Class Record
 * @package Model
 */
class Record
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $countryname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $zip;

    /**
     * @var string
     */
    private $dt;

    /**
     * @var integer
     */
    private $rate;

    /**
     * Record constructor.
     * @param array $data Data array
     */
    public function __construct(array $data)
    {
        $this->id = $data['id'];
        $this->username = $data['username'];
        $this->password = $data['password'];
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->countryname = $data['countryname'];
        $this->email = $data['email'];
        $this->zip = $data['zip'];
        $this->dt = $data['dt'];
        $this->rate = $data['rate'];
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getCountryname()
    {
        return $this->countryname;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getZip()
    {
        return $this->zip;
    }

    public function getDt()
    {
        return $this->dt;
    }

    public function setRating($rate)
    {
        $this->rate = $rate;
    }

    public function getRating()
    {
        return $this->rate;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}