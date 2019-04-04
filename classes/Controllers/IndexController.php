<?php

namespace TestTask\Controllers;

use TestTask\Exceptions\KeyAlreadyExistsException;
use TestTask\Facades\Request;
use TestTask\Facades\Storage;
use TestTask\Response;
use TestTask\Validator;
use Exception;

class IndexController extends BaseController
{
    /**
     * get
     */
    public function get(): array
    {
        $key = Request::input('key');

        $errorMessages = Validator::validate($key, 'not_empty|string|max_length:16', '`key`');

        if ($errorMessages) {
            return Response::validationError($errorMessages);
        }

        try {
            $result = Storage::get($key);
        } catch (Exception $exception) {
            return Response::error(['error' => $exception->getMessage()]);
        }

        if (empty($result)) {
            return Response::errorNotFound(['error' => 'not found']);
        }

        $result = $this->prepareResultForResponse($result);

        return Response::success($result);
    }

    /**
     * set
     */
    public function set(): array
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

        try {
            Storage::set($key, $value);
        } catch (KeyAlreadyExistsException $exception) {
            return Response::error(['error' => $exception->errorMessage()]);
        }

        return Response::success(['result' => 'success']);
    }

    /**
     * delete
     */
    public function delete(): array
    {
        $key = Request::input('key');

        $errorMessages = Validator::validate($key, 'not_empty|string|max_length:16', '`key`');

        if ($errorMessages) {
            return Response::validationError($errorMessages);
        }

        try {
            Storage::delete($key);
        } catch (Exception $exception) {
            return Response::error(['error' => $exception->getMessage()]);
        }

        return Response::success(['result' => 'success']);
    }

    /**
     * @param $result
     *
     * @return mixed
     */
    private function prepareResultForResponse(array $result): array
    {
        return array_shift($result);
    }
}