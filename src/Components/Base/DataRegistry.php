<?php

namespace Components\Base;

/**
 * Class DataRegistry
 *
 * @package Components\Base
 */
class DataRegistry extends Registry
{

    /**
     * @var array
     */
    private $container = array();

    /**
     * @var DataRegistry
     */
    private static $instance;

    /**
     * @return DataRegistry
     */
    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Function to save data
     *
     * @param string $key   key
     * @param mixed  $value value
     *
     * @return void
     */
    protected function set($key, $value)
    {
        $this->container[$key] = $value;
    }

    /**
     * @param string $key key
     *
     * @return mixed|null
     */
    protected function get($key)
    {
        if (isset($this->container[$key])) {
             return $this->container[$key];
        }

        return null;
    }

    /**
     * Static method to return record id
     *
     * @return integer|null
     */
    public static function getId()
    {
        return self::instance()->get('id');
    }

    /**
     * Static method to save record id
     *
     * @param integer $id Id
     *
     * @return array
     */
    public static function setId($id)
    {
        return self::instance()->set('id', $id);
    }

    /**
     * Static method to return year quarter
     *
     * @return integer|null
     */
    public static function getQuarter()
    {
        return self::instance()->get('quarter');
    }

    /**
     * Static method to save year quarter
     *
     * @param integer $quarter Quarter of year
     *
     * @return array
     */
    public static function setQuarter($quarter)
    {
        return self::instance()->set('quarter', $quarter);
    }

    /**
     * Static method to return Average value of rating for records had stored in DB
     *
     * @return float|null
     */
    public static function getAverage()
    {
        return self::instance()->get('average');
    }

    /**
     * Static method to save Average value of rating for records had stored in DB
     *
     * @param float $average Average value of rating for records had stored in DB
     *
     * @return array
     */
    public static function setAverage($average)
    {
        return self::instance()->set('average', $average);
    }
} 