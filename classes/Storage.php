<?php

namespace TestTask;

use TestTask\Exceptions\KeyAlreadyExistsException;
use TestTask\Exceptions\KeyDoesNotExistException;
use TestTask\Exceptions\StorageIsFullException;

class Storage extends BaseStorage
{
    /**
     * @var string
     */
    private $tableName = 'storage';

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->select("SELECT `key`, `value` FROM $this->tableName WHERE `key` = ?", [$key]);
    }

    /**
     * set
     *
     * @param string $key
     * @param string $value
     *
     * @return bool
     * @throws KeyAlreadyExistsException
     * @throws StorageIsFullException
     */
    public function set(string $key, string $value)
    {
        if ($this->isKeyExists($key)) {
            throw new KeyAlreadyExistsException('Key already exists.');
        } elseif ($this->isStorageFull()) {
            throw new StorageIsFullException('Storage is full.');
        }

        $query = "INSERT INTO $this->tableName (`key`, `value`) VALUES (:key, :value)";

        $status = $this->insert($query, ['key' => $key, 'value' => $value]);

        return $status;
    }

    /**
     * delete
     *
     * @param $key
     *
     * @return bool
     * @throws KeyDoesNotExistException
     */
    public function delete(string $key)
    {
        if ($this->isKeyDoesNotExist($key)) {
            throw new KeyDoesNotExistException('Key does not exist.');
        }

        $sql = "DELETE FROM $this->tableName WHERE `key` = ?";

        $status = $this->destroy($sql, [$key]);

        return $status;
    }

    /**
     * @param $key
     *
     * @return bool
     */
    private function isKeyExists(string $key): bool
    {
        $result = $this->select("SELECT `id` FROM $this->tableName WHERE `key` = ?", [$key]);

        return ! empty($result);
    }

    /**
     * @param $key
     *
     * @return bool
     */
    private function isKeyDoesNotExist(string $key): bool
    {
        return ! $this->isKeyExists($key);
    }

    /**
     * isStorageFull
     */
    private function isStorageFull()
    {
        $result = $this->select("SELECT COUNT(id) AS number_of_rows FROM $this->tableName");

        if (array_shift($result)[0] > STORAGE_MAX_NUMBER_OF_KEYS) {
            return true;
        }

        return false;
    }

}