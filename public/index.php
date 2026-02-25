<?php

require_once __DIR__ . '/../vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';

$routes = [
    '/'                    => __DIR__ . '/../src/Views/home/index.php',
    '/index.php'           => __DIR__ . '/../src/Views/home/index.php',

    // Programmes
    '/programmes'          => __DIR__ . '/../src/Views/programmes/index.php',
    '/programmes/show'     => __DIR__ . '/../src/Views/programmes/show.php',
    '/mes-programmes'      => __DIR__ . '/../src/Views/programmes/my-progs.php',

    // Prestations
    '/pages/cardio'        => __DIR__ . '/../src/Views/pages/cardio.php',
    '/pages/musculation'   => __DIR__ . '/../src/Views/pages/musculation.php',
    '/pages/cours'         => __DIR__ . '/../src/Views/pages/cours.php',
    '/pages/coaching'      => __DIR__ . '/../src/Views/pages/coaching.php',
    '/pages/bienetre'      => __DIR__ . '/../src/Views/pages/bienetre.php',

    // Pages
    '/pages/contact'       => __DIR__ . '/../src/Views/pages/contact.php',
    '/carriere'            => __DIR__ . '/../src/Views/pages/carriere.php',
    '/temoignages'         => __DIR__ . '/../src/Views/pages/temoignages.php',
    '/pages/legal'         => __DIR__ . '/../src/Views/pages/legal.php',
    '/pages/privacy'       => __DIR__ . '/../src/Views/pages/privacy.php',
    '/pages/terms'         => __DIR__ . '/../src/Views/pages/terms.php',

    // Auth & compte
    '/login'               => __DIR__ . '/../src/Views/auth/login.php',
    '/register'            => __DIR__ . '/../src/Views/auth/register.php',
    '/account'             => __DIR__ . '/../src/Views/auth/account.php',

    // Admin & modération
    '/admin'               => __DIR__ . '/../src/Views/admin/index.php',
    '/moderator'           => __DIR__ . '/../src/Views/moderator/index.php',
];

// Route dynamique : /programmes/show?id=X
if ($uri === '/programmes/show' && isset($_GET['id'])) {
    require __DIR__ . '/../src/Views/programmes/show.php';
    exit;
}

if (isset($routes[$uri])) {
    require $routes[$uri];
} else {
    http_response_code(404);
    require __DIR__ . '/../src/Views/templates/header.php';
    echo '<main class="container"><div class="card" style="text-align:center;"><h1>404</h1><p>Page introuvable.</p><a href="/" class="prog-btn">Retour à l\'accueil</a></div></main>';
    require __DIR__ . '/../src/Views/templates/footer.php';
}
