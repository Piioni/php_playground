<?php
include(__DIR__ . '/../config/config.php');

$urlMap = [
    route("/src/pages/") => 'homepage.php',
    route("/src/pages/login") => 'login.php',
    route('/src/pages/register') => 'register.php',
    route('/src/pages/logout') => 'logout.php',
];

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

// Normalizar la ruta eliminando una posible extensión .php
$normalizedPath = preg_replace('/\.php$/', '', $pathInfo);

if (isset($urlMap[$normalizedPath])) {
    // Cargar el script de la página específica
    include(__DIR__ . '/../pages/' . $urlMap[$normalizedPath]);
} elseif ($normalizedPath === '/') {
    // Cargar la página de inicio si la ruta es '/'
    include(__DIR__ . '/../src/pages/homepage.php');
} else {
    // Producir una respuesta 404
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include(__DIR__ . '/../src/pages/404.php');
}