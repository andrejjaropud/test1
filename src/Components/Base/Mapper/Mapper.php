<?php

namespace Components\Base\Mapper;

/**
 * Class Mapper
 * @package Components\Base\Mapper
 */
abstract class Mapper
{

    /**
     * @var \PDO
     */
    protected $adapter;

    /**
     * Constructor
     *
     * @param \PDO $adapter
     */
    public function __construct(\PDO $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Find record by id
     *
     * @param integer $id Identyfikator
     * @return array|null
     */
    public function find($id)
    {
        $statement = $this->selectStmt();
        $statement->bindParam(':id', $id, \PDO::PARAM_INT);
        $statement->execute();
        $result = $statement->get_result();
        $row = $result->fetch(\PDO::FETCH_ASSOC);
        $statement->closeCursor();

        if(!is_array($row)) {
            return null;
        }

        if (!isset($row['id'])) {
            return null;
        }

        return $row;
    }

    /**
     * @param array $data
     * @return object
     */
    public function createObject(array $data)
    {
        $obj = $this->doCreateObject($data);

        return $obj;
    }

    /**
     * Insert data to DB
     *
     * @param $obj
     */
    public function insert($obj)
    {
        $this->doInsert($obj);
    }

    abstract function update($object);
    protected abstract function doInsert($object);
    protected abstract function selectStmt();

} 