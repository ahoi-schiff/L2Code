<?php

// src/Core/Router.php

namespace App\Core;

class Router
{
    protected array $routes = [];

    public function addRoute(string $method, string $path, array|callable $handler): void
    {
        $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler
        ];
    }

    public function dispatch(): void
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $url = $_SERVER['REQUEST_URI'] ?? '/';
        $requestPath = parse_url($url, PHP_URL_PATH);
        foreach ($this->routes as $route) {
            // Konvertiert den Pfad in ein Regex-Muster, z.B. /posts/{id} -> #^/posts/(\w+)$#
            $pattern = '#^' . preg_replace('/\{(\w+)}/', '(\w+)', $route['path']) . '$#';
            if ($route['method'] === $requestMethod && preg_match($pattern, $requestPath, $matches)) {
                array_shift($matches); // Entfernt den kompletten Match aus den Ergebnissen

                $handler = $route['handler'];

                if (is_array($handler) && isset($handler[0]) && is_object($handler[0])) {
                    $controller = $handler[0];
                    $method = $handler[1];
                    call_user_func_array([$controller, $method], $matches);
                } elseif (is_callable($handler)) {
                    call_user_func_array($handler, $matches);
                }

            }
        }

        // Keine Route gefunden
        http_response_code(404);
        echo '404 Not Found';
    }
}
