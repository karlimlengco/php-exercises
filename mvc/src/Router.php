<?php

namespace Everwing;

class Router
{
    /**
     * Routes
     *
     * 'GET' => [
     *     '/users' => 'handler'
     * ]
     */
    protected $routes = [];
    protected $method;
    protected $requestUri;

    /**
     * [__construct description]
     * @param [type] $method     [description]
     * @param [type] $requestUri [description]
     */
    public function __construct($method, $requestUri)
    {
        $this->method = $method;

        if (false !== $pos = strpos($requestUri, '?')) {
            $requestUri = substr($requestUri, 0, $pos);
        }

        $this->requestUri = rawurldecode($requestUri);
    }

    /**
     * Adds route to the application
     * @param [type] $method  [description]
     * @param [type] $route   [description]
     * @param [type] $handler [description]
     */
    public function addRoute($method, $route, $handler)
    {
        $route = '/^' . str_replace('/', '\/', $route) . '$/';

        $this->routes[$method][$route] = $handler;
    }

    /**
     * [fire description]
     * @return [type] [description]
     */
    public function fire()
    {
        foreach ($this->routes[$this->method] as $pattern => $callback) {
            if (preg_match($pattern, $this->requestUri, $params)) {
                if (is_callable($callback)) {
                    return $callback();
                }

                list($class, $method) = explode('@', $callback);

                $class = new $class;

                array_shift($params);

                return call_user_func_array([$class, $method], $params);
            }
        }
        // $route = $this->routes[$this->method][$this->requestUri];

        // var_dump($this->routes);exit;
        // if (isset($this->routes[$this->method][$this->requestUri])) {
        //     $route = $this->routes[$this->method][$this->requestUri];

        //     if (is_callable($route)) {
        //         return $route();
        //     }

        //     list($class, $method) = explode('@', $route);

        //     return (new $class)->$method();
        // }

        http_response_code(404);
        exit;
    }
}