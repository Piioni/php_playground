<?php

return [
    'view_dirs' => [
        'auth' => __DIR__ . '/../src/view/auth',
        'dashboard' => __DIR__ . '/../src/view/dashboard',
        'pages' => __DIR__ . '/../src/view/pages',
        'layouts' => __DIR__ . '/../src/view/layouts',
        'errors' => __DIR__ . '/../src/view/errors',
    ],

    'routes' => [
        // Authentication
        '/login' => '/login.php',
        '/register' => '/register.php',
        '/logout' => '/logout.php',

        // Public pages
        '/' => '/homepage.php',
        '/homepage' => '/homepage.php',

        // Dashboard
        '/user_dashboard' => '/user_dashboard.php',
        '/admin_dashboard' => '/admin_dashboard.php',

        // Error pages
        '/404' => '/404.php',
    ]
];