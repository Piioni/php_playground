<?php
include(__DIR__ . '/../config/config.php');


$urlMap = [
    '/' => 'homepage.php',
    '/homepage' => 'homepage.php',
    '/login' => 'login.php',
    '/register' => 'register.php',
    '/logout' => 'logout.php',
];


// Obtener la ruta solicitada
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathInfo = str_replace(base_url, '', $requestUri);

if (isset($urlMap[$pathInfo])) {
    include(__DIR__ . '/../src/view/pages/' . $urlMap[$pathInfo]);
} else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
    include(__DIR__ . '/../src/view/pages/404.php');
    exit;
}