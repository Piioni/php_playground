<?php
$routeConfig = require __DIR__ . '/../config/routes.php';

function loadView(string $path, $view_dirs): void
{
    foreach ($view_dirs as $dir) {
        $fullPath = $dir . '/' . $path;
        if (file_exists($fullPath)) {
            include($fullPath);
            return;
        }
    }
    throw new RuntimeException("View not found: $path");
}

// Obtener la ruta solicitada y eliminar la parte base de la URL
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathInfo = rtrim($requestUri, '/') ?: '/';  // Normaliza rutas vacías a '/'


try {
    if (isset($routeConfig['routes'][$pathInfo])) {
        loadView($routeConfig['routes'][$pathInfo], $routeConfig['view_dirs']);
    } else {
        http_response_code(404);
        loadView($routeConfig['routes']['/404'], $routeConfig['view_dirs']);
    }
} catch (RuntimeException $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage();
}