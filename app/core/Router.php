<?php
class Router
{
    private array $routes = [];

    public function get(string $pattern, callable $handler): void
    {
        $this->routes['GET'][] = [$this->normalize($pattern), $handler];
    }

    public function post(string $pattern, callable $handler): void
    {
        $this->routes['POST'][] = [$this->normalize($pattern), $handler];
    }

    public function dispatch(string $method, string $uri): void
    {
        $routes = $this->routes[$method] ?? [];
        foreach ($routes as [$pattern, $handler]) {
            $params = [];
            if (preg_match($pattern, $uri, $matches)) {
                foreach ($matches as $key => $value) {
                    if (!is_int($key)) {
                        $params[$key] = $value;
                    }
                }
                call_user_func($handler, $params);
                return;
            }
        }
        http_response_code(404);
        View::render('frontend/404', [
            'title' => 'Sayfa bulunamadı',
        ]);
    }

    private function normalize(string $pattern): string
    {
        $pattern = rtrim($pattern, '/');
        if ($pattern === '') {
            $pattern = '/';
        }
        $regex = preg_replace('#\{([a-zA-Z_][a-zA-Z0-9_-]*)\}#', '(?P<$1>[a-zA-Z0-9\-_]+)', $pattern);
        return '#^' . $regex . '$#';
    }
}
