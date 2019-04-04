<?php

namespace TestTask\Facades;

abstract class Facade
{
    /**
     * The application facades.
     */
    protected static $appFacades;

    /**
     * The resolved object instances.*
     */
    protected static $resolvedInstance;

    /**
     * Resolve the facade root instance from the container.
     *
     * @param  string|object $name
     *
     * @return mixed
     */
    protected static function resolveFacadeInstance($name)
    {
        if ( ! isset(static::$appFacades)) {
            static::$appFacades = require_once ROOT_PATH . '/misc/app_facades.php';
        }

        if (is_object($name)) {
            return $name;
        }

        if (isset(static::$resolvedInstance[$name])) {
            return static::$resolvedInstance[$name];
        }

        return static::$resolvedInstance[$name] = static::$appFacades[$name];
    }

    /**
     * Get the root object behind the facade.
     *
     * @return mixed
     */
    public static function getFacadeRoot()
    {
        return static::resolveFacadeInstance(static::getFacadeAccessor());
    }

    /**
     * Handle dynamic, static calls to the object.
     *
     * @param  string $method
     * @param  array $args
     *
     * @return mixed
     *
     * @throws \RuntimeException
     */
    public static function __callStatic($method, $args)
    {
        $instance = static::getFacadeRoot();

        if ( ! $instance) {
            throw new \RuntimeException('A facade root has not been set.');
        }

        return $instance->$method(...$args);
    }
}