<?php

namespace Components\Base;

/**
 * abstract class for Registry
 */
abstract class Registry
{
    /**
     * Function to get registred value
     *
     * @param string $key key
     *
     * @return mixed value
     */
    abstract protected function get($key);

    /**
     * abstract function to save data
     *
     * @param string $key   key   Key
     * @param mixed  $value value Value
     *
     * @return mixed
     */
    abstract protected function set($key, $value);
}