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
     * @param $key
     *
     * @return mixed
     */
    protected function getByKey($key)
    {
        $stmt = $this->databaseDriver->prepare("SELECT * FROM storage WHERE `key` = ?");
        $stmt->execute([$key]);

        $result = $stmt->setFetchMode(\PDO::FETCH_ASSOC);

        return $stmt->fetchAll();
    }
}