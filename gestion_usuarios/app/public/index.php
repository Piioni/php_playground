<?php
include(__DIR__ . '/../config/config.php');

function loadView(string $viewPath): void
{
    $fullPath = __DIR__ . '/../src/view/pages/' . $viewPath;

    if (!file_exists($fullPath)) {
        throw new RuntimeException("View file not found: $viewPath");
    }

    include $fullPath;
}

// Obtener la ruta solicitada y eliminar la parte base de la URL

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathInfo = str_replace(base_url, '', $requestUri);
$pathInfo = rtrim($pathInfo, '/') ?: '/';  // Normaliza rutas vacías a '/'


$urlMap = [
    '/' => 'homepage.php',
    '/homepage' => 'homepage.php',
    '/login' => 'login.php',
    '/register' => 'register.php',
    '/logout' => 'logout.php',
];


if (isset($urlMap[$pathInfo])) {
    loadView($urlMap[$pathInfo]);
} else {
    loadView('404.php');
    http_response_code(404);
}