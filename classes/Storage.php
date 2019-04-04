<?php

namespace TestTask;

class Storage extends BaseStorage
{

    /**
     * @param $key
     *
     * @return mixed
     */
    public function get($key)
    {
        return $this->getByKey($key);
    }

    /**
     * set
     */
    public function set()
    {
        //
    }

    /**
     * delete
     */
    public function delete()
    {
        //
    }

}