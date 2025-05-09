<?php
include(__DIR__ . '/../src/config/config.php');

$urlMap = [
    route("/pages/") => 'homepage.php',
    route("/pages/login") => 'login.php',
    route('/pages/logout') => 'logout.php',
    route('/pages/register') => 'register.php',
];

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

// Normalizar la ruta eliminando una posible extensión .php
$normalizedPath = preg_replace('/\.php$/', '', $pathInfo);

if (isset($urlMap[$normalizedPath])) {
    // Cargar el script de la página específica
    include(__DIR__ . '/../pages/' . $urlMap[$normalizedPath]);
} elseif ($normalizedPath === '/') {
    // Cargar la página de inicio si la ruta es '/'
    include(__DIR__ . '/../pages/homepage.php');
} else {
    // Producir una respuesta 404
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include(__DIR__ . '/../pages/404.php');
}