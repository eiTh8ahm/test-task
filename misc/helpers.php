<?php

if ( ! function_exists('abort_404')) {

    /**
     * abort_404
     */
    function abort_404()
    {
        http_response_code(404);

        die();
    }
}

if ( ! function_exists('dd')) {

    /**
     * @param $var
     * @param bool $die
     * @param string $func
     */
    function dd($var, $die = true, $func = 'p')
    {
        echo '<pre>';

        if ($func === 'p') {
            print_r($var);
        } elseif ($func === 'v') {
            var_dump($var);
        }

        echo '</pre>';

        if ($die) {
            die;
        }
    }
}

if (!function_exists('env')) {

    /**
     * parse .env files and create constants
     */
    function env()
    {
        $env = file_get_contents(ROOT_PATH . '/.env');
        $env = explode(';', $env);

        foreach ($env as &$item) {
            $item = trim($item);
        }

        array_pop($env);

        foreach ($env as $item) {
            $elements = explode('=', $item);

            define($elements[0], $elements[1]);
        }
    }
}