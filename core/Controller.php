<?php

class Controller
{
    protected function view(string $viewPath, array $data = []): void
    {
        extract($data, EXTR_SKIP);
        // Views in this project still expect global model singletons like $ProductModel.
        // Since we include the view inside a method scope, we must re-import them.
        extract($GLOBALS, EXTR_SKIP);
        $fullPath = dirname(__DIR__) . '/views/' . ltrim($viewPath, '/');
        if (!is_file($fullPath)) {
            throw new RuntimeException('View not found: ' . $viewPath);
        }
        require $fullPath;
    }

    protected function redirect(string $url): void
    {
        header('Location: ' . $url);
        exit;
    }
}
