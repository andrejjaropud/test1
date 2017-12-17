<?php

namespace Components\Base\Mapper;

use Model\Record;


class RecordMapper extends Mapper
{
    public $selectStmt;
    public $selectStmtAvg;
    public $updateStmt;
    public $insertStmt;

    /**
     * Construktor
     *
     * @param \PDO $adapter
     */
    public function __construct(\PDO $adapter)
    {
        parent::__construct($adapter);
        $this->selectStmt = $this->adapter->prepare("SELECT * FROM users WHERE id = :id");
        $this->selectStmtAvg = $this->adapter->prepare(
            "SELECT AVG(rate)  FROM users WHERE registred >= '2016-01-01' AND  registred < :registered"
        );
        $this->updateStmt = $this->adapter->prepare('UPDATE users SET rate = :rate WHERE id = :id');
        $this->insertStmt = $this->adapter->prepare(
            'INSERT INTO users(username, password, firstname, lastname, country, zip, email, registred, rate) 
            VALUES (:username, :password, :firstname, :lastname, :country, :zip, :email, :registered, :rate)'
        );

    }

    /**
     * Insert  record to DB
     *
     * @param \Model\Record $record
     */
    protected function doInsert($record)
    {
        $this->insertStmt->bindParam(':username', $record->getUsername(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':password', $record->getPassword(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':firstname', $record->getFirstname(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':lastname', $record->getLastname(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':country', $record->getCountryname(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':zip', $record->getZip(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':email', $record->getEmail(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':registered', $record->getDt(), \PDO::PARAM_STR);
        $this->insertStmt->bindParam(':rate', $record->getRating(), \PDO::PARAM_INT);

        $this->insertStmt->execute();
        $record->setId($this->adapter->lastInsertId());
    }

    /**
     * Update calculated rate for record
     *
     * @param \Model\Record $record
     */
    public function update($record)
    {
        $this->updateStmt->bindParam(':rate', $record->getRating(), \PDO::PARAM_INT);
        $this->updateStmt->bindParam(':id', $record->getId(), \PDO::PARAM_INT);
        $this->updateStmt->execute();
    }

    /**
     * Get statement for get data from DB
     *
     * @return \PDOStatement
     */
    public function selectStmt()
    {
        return $this->selectStmt;
    }

    /**
     * Return average value of rating to defined date
     *
     * @param string $dt Date of registration
     *
     * @return integer
     */
    public function getAvg($dt) {
        $this->selectStmtAvg->bindParam(':registered', $dt, \PDO::PARAM_STR);
        $this->selectStmtAvg->execute();
        $average = $this->selectStmtAvg->fetchColumn();

        if(is_null($average)) {
            $average = 0;
        }

        return $average;

    }

    /**
     * @param $data
     * @return \Model\Record
     */
    protected function doCreateObject($data)
    {
        $obj = new Record($data);

        return $obj;
    }
} 