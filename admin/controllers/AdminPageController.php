<?php

class AdminPageController extends Controller
{
    public function render(string $viewPath): void
    {
        // Admin views also expect global model singletons.
        extract($GLOBALS, EXTR_SKIP);
        $fullPath = dirname(__DIR__) . '/' . ltrim($viewPath, '/');
        if (!is_file($fullPath)) {
            throw new RuntimeException('Admin view not found: ' . $viewPath);
        }
        require $fullPath;
    }
}

