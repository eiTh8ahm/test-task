<?php

namespace TestTask\Controllers;

use TestTask\Facades\Storage;

class IndexController extends BaseController
{
    /**
     * get
     */
    public function get()
    {
        $result = Storage::get('key');

        dd($result);
    }

    /**
     * set
     */
    public function set()
    {
        $key = 'testKey';
        $value = 'testValue';

        Storage::set($key, $value);
    }

    /**
     * delete
     */
    public function delete()
    {
        $key = 'testKey';

        Storage::delete($key);
    }

}