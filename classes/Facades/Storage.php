<?php

namespace TestTask\Facades;

class Storage extends Facade
{
    /**
     * getFacadeAccessor
     */
    protected static function getFacadeAccessor(): string
    {
        return 'storage';
    }
}