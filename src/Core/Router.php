<?php

namespace App\Core;

class Router
{
    private static array $routes = [];
    private static array $groupMiddleware = [];
    private static array $namedRoutes = [];

    public static function get($uri, $action)
    {
        return self::addRoute('GET', $uri, $action);
    }

    public static function post($uri, $action)
    {
        return self::addRoute('POST', $uri, $action);
    }

    public static function put($uri, $action)
    {
        return self::addRoute('PUT', $uri, $action);
    }

    public static function delete($uri, $action)
    {
        return self::addRoute('DELETE', $uri, $action);
    }

    public static function group($attributes, $callback)
    {
        $previousMiddleware = self::$groupMiddleware;

        if (isset($attributes['middleware'])) {
            self::$groupMiddleware = array_merge(
                self::$groupMiddleware,
                is_array($attributes['middleware'])
                    ? $attributes['middleware']
                    : [$attributes['middleware']]
            );
        }

        $callback();

        self::$groupMiddleware = $previousMiddleware;
    }

    private static function addRoute($method, $uri, $action)
    {
        $uri = '/' . trim($uri, '/');

        $route = [
            'method' => $method,
            'uri' => $uri,
            'action' => $action,
            'middleware' => self::$groupMiddleware,
            'pattern' => self::compilePattern($uri)
        ];

        self::$routes[] = $route;

        return $route;
    }

    private static function compilePattern($uri)
    {
        $pattern = preg_replace(
            '/\{[^}]+\}/',
            '([^/]+)',
            $uri
        );

        return '#^' . $pattern . '$#';
    }

    public static function dispatch($uri, $method)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        $uri = '/' . trim($uri, '/');

        foreach (self::$routes as $route) {

            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {

                array_shift($matches);

                // Si c’est une fonction anonyme
                if (is_callable($route['action'])) {
                    return call_user_func_array($route['action'], $matches);
                }

                // Si c’est "Controller@method"
                if (is_string($route['action'])) {

                    [$controller, $actionMethod] = explode('@', $route['action']);

                    $controller = "App\\Controllers\\$controller";

                    if (!class_exists($controller)) {
                        throw new \Exception("Controller $controller not found");
                    }

                    $instance = new $controller();

                    if (!method_exists($instance, $actionMethod)) {
                        throw new \Exception("Method $actionMethod not found in $controller");
                    }

                    return call_user_func_array([$instance, $actionMethod], $matches);
                }
            }
        }

        http_response_code(404);
        echo "404 Not Found";
    }
}