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
            'status_code'  => $statusCode,
            'headers' => $headers,
            'body'    => $body
        ];
    }

    /**
     * @param $data
     *
     * @return array
     */
    public static function error($data)
    {
        return [
            'status_code'  => 400,
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
    public static function validationError($data)
    {
        return [
            'status_code'  => 400,
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
    public static function errorNotFound($data)
    {
        return [
            'status_code'  => 404,
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
            'status_code'  => 200,
            'headers' => [
                'Content-type: application/json'
            ],
            'body'    => json_encode($data)
        ];
    }

    /**
     * @param $response
     */
    public static function send($response)
    {
        http_response_code($response['status_code']);

        foreach ($response['headers'] as $header) {
            header($header);
        }

        echo $response['body'];
    }
}