<?php
    require_once __DIR__ . '/../src/config/config.php';

    // Mapeo de rutas
    $urlMap = [
        '/' => '../pages/homepage.php',
        '/login' => '../pages/login.php',
        '/logout' => '../pages/logout.php',
        '/name' => '../pages/name.php',
        '/pictures' => '../pages/pictures.php',
        '/random' => '../pages/random.php',
        '/secret' => '../pages/secret.php',
        '/create_tour' => '../pages/tours/create_tour.php',
    ];

    // Obtener la URI de la solicitud
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Normalizar la URI eliminando la extensión .php si existe
    $requestUri = preg_replace('/\.php$/', '', $requestUri);

    // Verificar si la ruta existe en el mapeo
    if (isset($urlMap[$requestUri])) {
        include($urlMap[$requestUri]);
    } else {
        // Manejo de error 404
        header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
        include('../pages/404.php');
    }