<?php

namespace App\Core;

class Router {
    private array $routes = [];
    private array $middlewares = [];

    public function get(string $path, array|string $handler, array $middleware = []): void {
        $this->addRoute('GET', $path, $handler, $middleware);
    }

    public function post(string $path, array|string $handler, array $middleware = []): void {
        $this->addRoute('POST', $path, $handler, $middleware);
    }

    public function put(string $path, array|string $handler, array $middleware = []): void {
        $this->addRoute('PUT', $path, $handler, $middleware);
    }

    public function delete(string $path, array|string $handler, array $middleware = []): void {
        $this->addRoute('DELETE', $path, $handler, $middleware);
    }

    private function addRoute(string $method, string $path, array|string $handler, array $middleware = []): void {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'middleware' => $middleware,
        ];
    }

    public function dispatch(): void {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $basePath = dirname($_SERVER['SCRIPT_NAME']);

        // Normalize hosts that expose index.php in the request path
        if ($path === '/index.php') {
            $path = '/';
        } elseif (str_starts_with($path, '/index.php/')) {
            $path = substr($path, strlen('/index.php'));
        }
        
        if ($basePath !== '/' && str_starts_with($path, $basePath)) {
            $path = substr($path, strlen($basePath));
        }
        
        if (empty($path)) {
            $path = '/';
        }

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) {
                continue;
            }

            $params = [];
            if ($this->matchRoute($route['path'], $path, $params)) {
                // Run middleware
                foreach ($route['middleware'] as $middleware) {
                    $middlewareClass = $middleware;
                    $mw = new $middlewareClass();
                    if (!$mw->handle()) {
                        return;
                    }
                }

                // Call handler
                if (is_string($route['handler'])) {
                    $route['handler'] = explode('@', $route['handler']);
                }

                if (is_array($route['handler'])) {
                    [$controller, $method] = $route['handler'];
                    $controllerClass = "App\\Controllers\\$controller";
                    $instance = new $controllerClass();
                    $instance->$method(...array_values($params));
                } else {
                    call_user_func($route['handler']);
                }
                return;
            }
        }

        // 404
        http_response_code(404);
        header('X-Robots-Tag: noindex, follow');
        echo "404 Not Found";
    }

    private function matchRoute(string $pattern, string $path, array &$params): bool {
        $pattern = preg_replace_callback('/\{([a-zA-Z_][a-zA-Z0-9_]*)\}/', static fn($m) => '(?P<' . $m[1] . '>[^/]+)', $pattern);
        $pattern = "#^$pattern$#";

        if (preg_match($pattern, $path, $matches)) {
            $params = array_filter($matches, static fn($k) => is_string($k), ARRAY_FILTER_USE_KEY);
            return true;
        }

        return false;
    }
}
