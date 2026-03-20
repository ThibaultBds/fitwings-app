<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $groupMiddleware = [];

    public function get($uri, $action): void
    {
        $this->addRoute('GET', $uri, $action);
    }

    public function post($uri, $action): void
    {
        $this->addRoute('POST', $uri, $action);
    }

    public function put($uri, $action): void
    {
        $this->addRoute('PUT', $uri, $action);
    }

    public function delete($uri, $action): void
    {
        $this->addRoute('DELETE', $uri, $action);
    }

    public function group(array $attributes, callable $callback): void
    {
        $previousMiddleware = $this->groupMiddleware;

        if (isset($attributes['middleware'])) {
            $this->groupMiddleware = array_merge(
                $this->groupMiddleware,
                is_array($attributes['middleware'])
                    ? $attributes['middleware']
                    : [$attributes['middleware']]
            );
        }

        $callback($this);

        $this->groupMiddleware = $previousMiddleware;
    }

    private function addRoute(string $method, string $uri, $action): void
    {
        $uri = '/' . trim($uri, '/');

        $this->routes[] = [
            'method'     => $method,
            'uri'        => $uri,
            'action'     => $action,
            'middleware' => $this->groupMiddleware,
            'pattern'    => $this->compilePattern($uri),
        ];
    }

    private function compilePattern(string $uri): string
    {
        $pattern = preg_replace('/\{[^}]+\}/', '([^/]+)', $uri);
        return '#^' . $pattern . '$#';
    }

    public function dispatch(string $uri, string $method): void
    {
        $uri = '/' . trim(parse_url($uri, PHP_URL_PATH), '/');

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            if (preg_match($route['pattern'], $uri, $matches)) {
                array_shift($matches);

                foreach ($route['middleware'] as $middleware) {
                    $middlewareClass = "App\\Middleware\\$middleware";
                    (new $middlewareClass())->handle();
                }

                if (is_callable($route['action'])) {
                    call_user_func_array($route['action'], $matches);
                    return;
                }

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

                    call_user_func_array([$instance, $actionMethod], $matches);
                    return;
                }
            }
        }

        http_response_code(404);
        require __DIR__ . '/../../src/Views/errors/404.php';
    }
}
