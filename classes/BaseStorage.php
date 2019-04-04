<?php

namespace TestTask;

class BaseStorage
{
    /**
     * @var
     */
    protected $databaseDriver;

    /**
     * Storage constructor.
     *
     * @param $databaseDriver
     */
    public function __construct($databaseDriver)
    {
        $this->databaseDriver = $databaseDriver;
    }

    /**
     * @param $query
     * @param $params
     *
     * @return mixed
     */
    protected function select($query, $params)
    {
        $stmt = $this->databaseDriver->prepare($query);
        $stmt->execute($params);

        $result = $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }

    /**
     * @param $query
     * @param $params
     *
     * @return bool
     */
    protected function insert($query, $params)
    {
        $stmt   = $this->databaseDriver->prepare($query);
        $result = $stmt->execute($params);

        if ($result) {
            return true;
        }

        return false;
    }

    /**
     * @param $query
     * @param $params
     *
     * @return bool
     */
    protected function destroy($query, $params)
    {
        $stmt   = $this->databaseDriver->prepare($query);
        $result = $stmt->execute($params);

        if ($result) {
            return true;
        }

        return false;
    }
}