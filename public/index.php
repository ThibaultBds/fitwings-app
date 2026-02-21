<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';

$routes = [
    '/'                   => __DIR__ . '/../src/Views/home/index.php',
    '/programmes'         => __DIR__ . '/../src/Views/programmes/index.php',
    '/pages/cardio'       => __DIR__ . '/../src/Views/pages/cardio.php',
    '/pages/musculation'  => __DIR__ . '/../src/Views/pages/musculation.php',
    '/pages/cours'        => __DIR__ . '/../src/Views/pages/cours.php',
    '/pages/coaching'     => __DIR__ . '/../src/Views/pages/coaching.php',
    '/pages/bienetre'     => __DIR__ . '/../src/Views/pages/bienetre.php',
    '/pages/contact'      => __DIR__ . '/../src/Views/pages/contact.php',
    '/login'              => __DIR__ . '/../src/Views/auth/login.php',
    '/register'           => __DIR__ . '/../src/Views/auth/register.php',
];

if (isset($routes[$uri])) {
    require $routes[$uri];
} else {
    http_response_code(404);
    echo '<h1>404 – Page introuvable</h1>';
}
