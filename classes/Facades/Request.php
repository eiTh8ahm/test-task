<?php

namespace TestTask\Facades;

class Request extends Facade
{
    /**
     * getFacadeAccessor
     */
    protected static function getFacadeAccessor()
    {
        return 'request';
    }
}