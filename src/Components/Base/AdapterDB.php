<?php

namespace Components\Base;

/**
 * DB Adapter
 *
 * Class AdapterDB
 * @package Components\Base
 */
class AdapterDB {

    /**
     * @var bool
     */
    private $connected = false;

    /**
     * @var string
     */
    private static $hostname ;

    /**
     * @var string
     */
    private static $username;

    /**
     * @var string
     */
    private static $password ;

    /**
     * @var string
     */
    private static $database;

    /**
     * @var integer
     */
    private static $port;

    /**
     * @var string
     */
    private static $charset;

    /**
     * @var AdapterDB
     */
    private static $instance;

    /**
     * @var \PDO
     */
    private $dbConn;

    private function __construct() {}

    /**
     * Get the singleton instance.
     *
     * @param string  $hostname Host name
     * @param string  $username User login
     * @param string  $password User password
     * @param string  $database Name of DB
     * @param integer $port     Port number
     * @param string  $charset  Charset
     *
     * @return AdapterDB
     */
    private static function getInstance($hostname, $username, $password, $database, $port, $charset)
    {
        if (self::$instance == null) {
            $className = __CLASS__;
            self::$instance = new $className;
            self::$hostname = $hostname;
            self::$username = $username;
            self::$password = $password;
            self::$database = $database;
            self::$port = $port;
            self::$charset = $charset;
        }

        return self::$instance;
    }


    /**
     * @param string  $hostname Host name
     * @param string  $username User login
     * @param string  $password User password
     * @param string  $database Name of DB
     * @param integer $port     Port number
     * @param string  $charset  Charset
     *
     * @return AdapterDB
     */
    private static function initConnection($hostname, $username, $password, $database, $port, $charset)
    {
        $db = self::getInstance($hostname, $username, $password, $database, $port, $charset);
        $hostname = self::$hostname;
        $port = self::$port;
        $database = self::$database;
        $dsn = "mysql:$hostname;port=$port;dbname=$database";
        $options = array(
            \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . self::$charset,
        );

        $db->dbConn = new \PDO(
            $dsn,
            self::$username,
            self::$password,
            $options
        );

        return $db;
    }


    /**
     * @param string  $hostname Host name
     * @param string  $username User login
     * @param string  $password User password
     * @param string  $database Name of DB
     * @param integer $port     Port number
     * @param string  $charset  Charset
     *
     * @return \PDO|null
     */
    public static function getDbConn($hostname, $username, $password, $database, $port = 3306, $charset = 'utf8') {
        try {
            $db = self::initConnection($hostname, $username, $password, $database, $port, $charset);
            return $db->dbConn;
        } catch (\Exception $ex) {
            echo "I was unable to open a connection to the database. " . $ex->getMessage();
            return null;
        }
    }

    public function lastInsertId(){
        return $this->dbConn->lastInsertId();
    }
} 