<?php

class Autoloader
{

    /**
     * Loader
     *
     * @param string $className Class name
     *
     * @return boolean
     */
    public static function loader($className)
    {
        $filename = __DIR__ . DIRECTORY_SEPARATOR . str_replace('\\', '/', $className) . '.php';
        if (file_exists($filename)) {
            include_once($filename);
            if (class_exists($className)) {
                return true;
            }
        }
        return false;
    }
}
