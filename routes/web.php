<?php

declare(strict_types=1);

use App\Core\Router;

$router->get('/login', 'AuthController@login');
$router->post('/login', 'AuthController@login');
$router->get('/register', 'AuthController@register');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

$router->group(['middleware' => 'AuthMiddleware'], function (Router $router) {
    $router->get('/account', 'AccountController@index');
    $router->post('/account/progression', 'AccountController@saveProgression');
    $router->get('/mes-programmes', 'MesProgrammesController@index');
    $router->post('/mes-programmes/desinscrire', 'MesProgrammesController@unsubscribe');
    $router->post('/programmes/inscrire', 'ProgrammeController@inscrire');
    $router->post('/temoignages', 'TemoignageController@index');
});

$router->group(['middleware' => 'ModeratorMiddleware'], function (Router $router) {
    $router->get('/moderator', 'ModeratorController@index');
    $router->post('/moderator/moderer', 'ModeratorController@moderer');
});

$router->group(['middleware' => 'AdminMiddleware'], function (Router $router) {
    $router->get('/admin', 'AdminController@index');
    $router->post('/admin/moderer', 'AdminController@modererTemoignage');
    $router->post('/admin/role', 'AdminController@updateRole');
    $router->post('/admin/delete', 'AdminController@deleteUser');
    $router->post('/admin/users/create', 'AdminController@createUser');
    $router->post('/admin/programmes/create', 'AdminController@createProgramme');
    $router->post('/admin/programmes/update', 'AdminController@updateProgramme');
    $router->post('/admin/programmes/delete', 'AdminController@deleteProgramme');
    $router->post('/admin/salles/create', 'AdminController@createSalle');
    $router->post('/admin/salles/update', 'AdminController@updateSalle');
    $router->post('/admin/salles/delete', 'AdminController@deleteSalle');
});

$router->get('/', function () {
    require __DIR__ . '/../src/Views/home/index.php';
});

$router->get('/programmes', 'ProgrammeController@index');
$router->get('/programmes/show', 'ProgrammeController@show');

$router->get('/salles', 'SalleController@index');
$router->get('/salles/show', 'SalleController@show');

$router->get('/pages/cardio', function () {
    require __DIR__ . '/../src/Views/pages/cardio.php';
});
$router->get('/pages/musculation', function () {
    require __DIR__ . '/../src/Views/pages/musculation.php';
});
$router->get('/pages/cours', 'ReservationController@index');
$router->post('/pages/cours', 'ReservationController@index');
$router->get('/pages/coaching', function () {
    require __DIR__ . '/../src/Views/pages/coaching.php';
});
$router->get('/pages/bienetre', function () {
    require __DIR__ . '/../src/Views/pages/bienetre.php';
});
$router->get('/abonnements', function () {
    require __DIR__ . '/../src/Views/pages/abonnements.php';
});

$router->get('/pages/contact', 'ContactController@index');
$router->post('/pages/contact', 'ContactController@index');
$router->get('/carriere', 'CarriereController@index');
$router->post('/carriere', 'CarriereController@index');
$router->get('/temoignages', 'TemoignageController@index');

$router->get('/pages/legal', function () {
    require __DIR__ . '/../src/Views/pages/legal.php';
});
$router->get('/pages/privacy', function () {
    require __DIR__ . '/../src/Views/pages/privacy.php';
});
$router->get('/pages/terms', function () {
    require __DIR__ . '/../src/Views/pages/terms.php';
});
