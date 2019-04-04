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
        echo 'set';
    }

    /**
     * delete
     */
    public function delete()
    {
        echo 'delete';
    }

}