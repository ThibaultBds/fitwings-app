<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Core\Router;

// Auth
Router::get('/login', 'AuthController@login');
Router::post('/login', 'AuthController@login');
Router::get('/register', 'AuthController@register');
Router::post('/register', 'AuthController@register');
Router::get('/logout', 'AuthController@logout');

// Compte (protégé)
Router::group(['middleware' => 'AuthMiddleware'], function () {
    Router::get('/account', 'AccountController@index');
    Router::post('/account/progression', 'AccountController@saveProgression');
    Router::get('/mes-programmes', 'MesProgrammesController@index');
    Router::post('/programmes/inscrire', 'ProgrammeController@inscrire');
    Router::get('/admin', 'AdminController@index');
    Router::post('/admin/moderer', 'AdminController@modererTemoignage');
    Router::post('/admin/role', 'AdminController@updateRole');
    Router::post('/admin/delete', 'AdminController@deleteRole');
});

// Home
Router::get('/', function () {
    require __DIR__ . '/../src/Views/home/index.php';
});

// Programmes
Router::get('/programmes', 'ProgrammeController@index');
Router::get('/programmes/show', 'ProgrammeController@show');

// Prestations
Router::get('/pages/cardio', function () {
    require __DIR__ . '/../src/Views/pages/cardio.php';
});
Router::get('/pages/musculation', function () {
    require __DIR__ . '/../src/Views/pages/musculation.php';
});
Router::get('/pages/cours', function () {
    require __DIR__ . '/../src/Views/pages/cours.php';
});
Router::get('/pages/coaching', function () {
    require __DIR__ . '/../src/Views/pages/coaching.php';
});
Router::get('/pages/bienetre', function () {
    require __DIR__ . '/../src/Views/pages/bienetre.php';
});

// Abonnements
Router::get('/abonnements', function () {
    require __DIR__ . '/../src/Views/pages/abonnements.php';
});

// Pages
Router::get('/pages/contact', function () {
    require __DIR__ . '/../src/Views/pages/contact.php';
});
Router::get('/carriere', 'CarriereController@index');
Router::post('/carriere', 'CarriereController@index');
Router::get('/temoignages', 'TemoignageController@index');
Router::post('/temoignages', 'TemoignageController@index');
Router::get('/pages/legal', function () {
    require __DIR__ . '/../src/Views/pages/legal.php';
});
Router::get('/pages/privacy', function () {
    require __DIR__ . '/../src/Views/pages/privacy.php';
});
Router::get('/pages/terms', function () {
    require __DIR__ . '/../src/Views/pages/terms.php';
});

// Salles
Router::get('/salles', 'SalleController@index');
Router::get('/salles/show', 'SalleController@show');


// Dispatch
Router::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
