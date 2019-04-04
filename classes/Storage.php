<?php

namespace TestTask;

class Storage extends BaseStorage
{

    private $tableName = 'storage';

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->select('SELECT * FROM $this->tableName WHERE `key` = ?', [$key]);
    }

    /**
     * set
     *
     * @param $key
     * @param $value
     */
    public function set($key, $value)
    {
        $query = "INSERT INTO $this->tableName (`key`, `value`) VALUES (:key, :value)";

        $this->insert($query, ['key' => $key, 'value' => $value]);
    }

    /**
     * delete
     *
     * @param $key
     */
    public function delete($key)
    {
        $sql = "DELETE FROM $this->tableName WHERE `key` = ?";

        $this->delete($sql, [$key]);
    }

}