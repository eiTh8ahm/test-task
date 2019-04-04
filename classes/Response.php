<?php

namespace TestTask;

class Response
{

    /**
     * @param $statusCode
     * @param $body
     * @param array $headers
     *
     * @return array
     */
    public static function response($statusCode, $body, $headers = [])
    {
        return [
            'status'  => $statusCode,
            'headers' => $headers,
            'body'    => $body
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function validationError($data)
    {
        return [
            'status'  => 400,
            'headers' => [
                'Content-type: application/json'
            ],
            'body'    => json_encode($data)
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function success($data)
    {
        return [
            'status'  => 200,
            'headers' => [
                'Content-type: application/json'
            ],
            'body'    => json_encode($data)
        ];
    }
}