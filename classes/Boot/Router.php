<?php

namespace TestTask\Boot;

use TestTask\Controllers\BaseController;

class Router
{
    /**
     * @var array|mixed
     */
    private $routes = [];

    /**
     * @var
     */
    private $requestUri;

    /**
     * @var string
     */
    private $requestedRoute;

    /**
     * @var string
     */
    private $routesFile = ROOT_PATH . '/misc/routes.php';

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $this->routes         = is_file($this->routesFile) ? require_once $this->routesFile : [];
        $this->requestUri     = $this->getRequestUri();
        $this->requestedRoute = $_SERVER['REQUEST_METHOD'] . ':' . $this->requestUri;

        $this->run();
    }

    /**
     * @return mixed
     */
    private function run()
    {
        if ($this->isRouteExists()) {

            $handler = $this->routes[$this->requestedRoute];
            $class   = explode('@', $handler)[0];
            $method  = explode('@', $handler)[1];

            $className = '\\' . BaseController::$namespace . '\\' . $class;
            $response = (new $className($method))->$method();

        } else {
            abort_404();
        }

        dd($response);
    }

    /**
     * @return bool|string
     */
    public function getRequestUri()
    {
        $uri = explode('?', $_SERVER['REQUEST_URI'], 2)[0];

        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = substr($uri, 0, -1);
        }

        return $uri;
    }

    /**
     * @return bool
     */
    private function isRouteExists()
    {
        $requestedRoute = $_SERVER['REQUEST_METHOD'] . ':' . $this->requestUri;

        $exists = array_key_exists($requestedRoute, $this->routes);

        return $exists;
    }

}