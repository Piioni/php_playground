<?php
require_once __DIR__ . '/../src/config/config.php';


$urlMap = [
    route('/pages/') => 'homepage.php',
    route("/pages/login") => 'login.php',
    route('/pages/logout') => 'logout.php',
    route('/pages/name') => 'name.php',
    route('/pages/pictures') => 'pictures.php',
    route('/pages/random') => 'random.php',
    route('/pages/secret') => 'secret.php',
    route('/pages/create_tour') => 'tours.php',

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