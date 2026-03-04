<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/') ?: '/';

// LOGIN POST

if ($uri === '/login' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $error = "Toues les champs sont obligatoires.";
        require __DIR__ . '/../src/Views/auth/login.php';
        exit;
    }

    try {
        $db = \App\Core\Database::getInstance()->getConnection();

        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {

            $_SESSION['user'] = [
    'id' => $user['id'],
    'username' => $user['username'],
    'email' => $user['email'],
    'role' => $user['role'] ?? 'user'
];

            header('Location: /account');
            exit;
        }

        $error = "Identifiants invalides.";
        require __DIR__ . '/../src/Views/auth/login.php';
        exit;
    } catch (Exception $e) {
        $error = "Erreur serveur.";
        require __DIR__ . '/../src/Views/auth/login.php';
        exit;
    }
}

// REGISTER POST

if ($uri === '/register' && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($username === '' || $email === '' || $password === '') {
        $error = "Tous les champs sont obligatoires.";
        require __DIR__ . '/../src/Views/auth/register.php';
        exit;
    }

    try {
        $db = \App\Core\Database::getInstance()->getConnection();

        // Vérifier email déjà utilisé
        $stmt = $db->prepare("SELECT id FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        if ($stmt->fetch()) {
            $error = "Email déjà utilisé.";
            require __DIR__ . '/../src/Views/auth/register.php';
            exit;
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $db->prepare("
            INSERT INTO users (username, email, password, role)
            VALUES (:username, :email, :password, 'user')
        ");

        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $hashedPassword
        ]);

        $userId = $db->lastInsertId();

        $_SESSION['user'] = [
    'id' => $userId,
    'username' => $username,
    'email' => $email,
    'role' => 'user'
];

        header('Location: /account');
        exit;

    } catch (Exception $e) {
        $error = "Erreur serveur.";
        require __DIR__ . '/../src/Views/auth/register.php';
        exit;
    }
}

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

    // Abonnements
    '/abonnements'         => __DIR__ . '/../src/Views/pages/abonnements.php',

    // Pages
    '/pages/contact'       => __DIR__ . '/../src/Views/pages/contact.php',
    '/carriere'            => __DIR__ . '/../src/Views/pages/carriere.php',
    '/temoignages'         => __DIR__ . '/../src/Views/pages/temoignages.php',
    '/pages/legal'         => __DIR__ . '/../src/Views/pages/legal.php',
    '/pages/privacy'       => __DIR__ . '/../src/Views/pages/privacy.php',
    '/pages/terms'         => __DIR__ . '/../src/Views/pages/terms.php',

    // Salles de sport
    '/salles'              => __DIR__ . '/../src/Views/salles/index.php',
    '/salles/show'         => __DIR__ . '/../src/Views/salles/show.php',

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

// Route : /salles — liste des salles par ville
if ($uri === '/salles') {
    $salles = [];
    $ville = htmlspecialchars(trim($_GET['ville'] ?? ''));
    if ($ville !== '') {
        try {
            $db = \App\Core\Database::getInstance()->getConnection();
            $stmt = $db->prepare("SELECT * FROM salle WHERE ville LIKE :ville ORDER BY nom");
            $stmt->execute(['ville' => '%' . $ville . '%']);
            $salles = $stmt->fetchAll();
        } catch (\Exception $e) {
            $salles = [];
        }
    }
    require __DIR__ . '/../src/Views/salles/index.php';
    exit;
}

// Route dynamique : /salles/show?id=X
if ($uri === '/salles/show' && isset($_GET['id'])) {
    $salle = null;
    try {
        $db = \App\Core\Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM salle WHERE id = :id");
        $stmt->execute(['id' => (int)$_GET['id']]);
        $salle = $stmt->fetch();
    } catch (\Exception $e) {
        $salle = null;
    }
    require __DIR__ . '/../src/Views/salles/show.php';
    exit;
}

if ($uri === '/logout') {
    session_destroy();
    header('Location: /');
    exit;
}

if ($uri === '/account') {
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit;
    }

    require __DIR__ . '/../src/Views/auth/account.php';
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
