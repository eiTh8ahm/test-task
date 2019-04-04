<?php

namespace TestTask\Controllers;

use TestTask\Facades\Request;
use TestTask\Facades\Storage;
use TestTask\Response;
use TestTask\Validator;

class IndexController extends BaseController
{
    /**
     * get
     */
    public function get()
    {
        $key = Request::input('key');

        $errorMessages = Validator::validate($key, 'not_empty|string|max_length:16', '`key`');

        if ($errorMessages) {
            return Response::validationError($errorMessages);
        }

        $result = Storage::get($key);

        return Response::success($result);
    }

    /**
     * set
     */
    public function set()
    {
        $key   = Request::input('key');
        $value = Request::input('value');

        $errorMessages = array_merge(
            Validator::validate($key, 'not_empty|string|max_length:16', '`key`'),
            Validator::validate($value, 'not_empty|string|max_length:512', '`value`')
        );

        if ($errorMessages) {
            return Response::validationError($errorMessages);
        }

        Storage::set($key, $value);
    }

    /**
     * delete
     */
    public function delete()
    {
        $key = Request::input('key');

        $errorMessages = Validator::validate($key, 'not_empty|string|max_length:16', '`key`');

        if ($errorMessages) {
            return Response::validationError($errorMessages);
        }

        Storage::delete($key);
    }
}