<?php
require_once __DIR__ . '/../src/config/config.php';

$urlMap = [
    route('/pages/') => '/pages/homepage.php',
    route('/pages/login') => '/pages/login.php',
    route('/pages/logout') => '/pages/logout.php',
    route('/pages/tasks') => '/pages/tasks.php',
];

$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

if (isset($urlMap[$pathInfo])) {
    // Cargar el script de la página específica
    include(__DIR__ . '/../pages/' . $urlMap[$pathInfo]);
} elseif ($pathInfo === '/') {
    // Cargar la página de inicio si la ruta es '/'
    include(__DIR__ . '/../pages/homepage.php');
} else {
    // Producir una respuesta 404
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include(__DIR__ . '/../pages/404.php');
}