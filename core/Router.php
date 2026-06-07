<?php

class Router
{
    private array $routes = [];

    public function get(string $slug, callable $handler): void
    {
        $this->routes[$slug] = $handler;
    }

    public function dispatch(?string $slug): void
    {
        if ($slug === null || $slug === '') {
            $handler = $this->routes['__home__'] ?? null;
            if ($handler) {
                $handler();
                return;
            }
        }

        if (isset($this->routes[$slug])) {
            ($this->routes[$slug])();
            return;
        }

        $notFound = $this->routes['__404__'] ?? null;
        if ($notFound) {
            $notFound();
            return;
        }

        http_response_code(404);
        echo '404 Not Found';
    }
}
