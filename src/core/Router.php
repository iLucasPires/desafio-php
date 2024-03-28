<?php

class Router
{
    public $uri;
    public $method;

    public function __construct()
    {
        $this->uri = $this->getCurrentUri();
        $this->method = $this->getCurrentMethod();
    }

    private function getCurrentUri(): string
    {
        $uri = strtok($_SERVER['REQUEST_URI'], '?');
        return rawurldecode(parse_url($uri, PHP_URL_PATH));
    }

    private function getCurrentMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    private function verifyRoute($method, $route): bool
    {
        return $this->method === $method && $this->uri === $route;
    }

    private function handleRequest($method, $route, $handler)
    {
        if (!$this->verifyRoute($method, $route)) {
            return;
        }

        [$class, $method] = explode('@', $handler);

        if (!class_exists($class)) {
            throw new InvalidArgumentException("Class '$class' not found");
            return;
        }

        $obj = new $class();

        if (!method_exists($obj, $method)) {
            throw new InvalidArgumentException("Method '$method' not found");
            return;
        }

        $obj->$method();
    }

    public function get($route, $callback)
    {
        $this->handleRequest('GET', $route, $callback);
    }

    public function post($route, $callback)
    {
        $this->handleRequest('POST', $route, $callback);
    }

    public function put($route, $callback)
    {
        $this->handleRequest('PUT', $route, $callback);
    }

    public function delete($route, $callback)
    {
        $this->handleRequest('DELETE', $route, $callback);
    }

    public function patch($route, $callback)
    {
        $this->handleRequest('PATCH', $route, $callback);
    }
}
