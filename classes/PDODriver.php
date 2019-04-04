<?php

namespace TestTask;

class PDODriver
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * PDODriver constructor.
     *
     * @param $host
     * @param $username
     * @param $password
     * @param $dbName
     */
    public function __construct(string $host, string $username, string $password, string $dbName)
    {
        $this->connection = new \PDO("mysql:host=$host;dbname=$dbName", $username, $password);

        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @return \PDO
     */
    public function getConnection()
    {
        return $this->connection;
    }
}