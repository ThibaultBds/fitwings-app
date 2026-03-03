<?php

namespace App\Core;

class Router
{
    private static $routes = [];
    private static $groupMiddleware = [];
    private static $namedRoutes = [];

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
                is_array($attributes['middleware']) ? $attributes['middleware'] : [$attributes['middleware']]
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

            return new Route ($route);
    }

    private static function compilePattern($uri)
    {
        $pattern = p^reg_r
    }