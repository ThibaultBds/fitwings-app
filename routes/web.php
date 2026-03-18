<?php

declare(strict_types=1);

use App\Core\Router;

Router::get('/login', 'AuthController@login');
Router::post('/login', 'AuthController@login');
Router::get('/register', 'AuthController@register');
Router::post('/register', 'AuthController@register');
Router::get('/logout', 'AuthController@logout');

Router::group(['middleware' => 'AuthMiddleware'], function () {
    Router::get('/account', 'AccountController@index');
    Router::post('/account/progression', 'AccountController@saveProgression');
    Router::get('/mes-programmes', 'MesProgrammesController@index');
    Router::post('/mes-programmes/desinscrire', 'MesProgrammesController@unsubscribe');
    Router::post('/programmes/inscrire', 'ProgrammeController@inscrire');
    Router::post('/temoignages', 'TemoignageController@index');
});

Router::group(['middleware' => 'ModeratorMiddleware'], function () {
    Router::get('/moderator', 'ModeratorController@index');
    Router::post('/moderator/moderer', 'ModeratorController@moderer');
});

Router::group(['middleware' => 'AdminMiddleware'], function () {
    Router::get('/admin', 'AdminController@index');
    Router::post('/admin/moderer', 'AdminController@modererTemoignage');
    Router::post('/admin/role', 'AdminController@updateRole');
    Router::post('/admin/delete', 'AdminController@deleteUser');
    Router::post('/admin/users/create', 'AdminController@createUser');
    Router::post('/admin/programmes/create', 'AdminController@createProgramme');
    Router::post('/admin/programmes/update', 'AdminController@updateProgramme');
    Router::post('/admin/programmes/delete', 'AdminController@deleteProgramme');
    Router::post('/admin/salles/create', 'AdminController@createSalle');
    Router::post('/admin/salles/update', 'AdminController@updateSalle');
    Router::post('/admin/salles/delete', 'AdminController@deleteSalle');
});

Router::get('/', function () {
    require __DIR__ . '/../src/Views/home/index.php';
});

Router::get('/programmes', 'ProgrammeController@index');
Router::get('/programmes/show', 'ProgrammeController@show');

Router::get('/salles', 'SalleController@index');
Router::get('/salles/show', 'SalleController@show');

Router::get('/pages/cardio', function () {
    require __DIR__ . '/../src/Views/pages/cardio.php';
});
Router::get('/pages/musculation', function () {
    require __DIR__ . '/../src/Views/pages/musculation.php';
});
Router::get('/pages/cours', 'ReservationController@index');
Router::post('/pages/cours', 'ReservationController@index');
Router::get('/pages/coaching', function () {
    require __DIR__ . '/../src/Views/pages/coaching.php';
});
Router::get('/pages/bienetre', function () {
    require __DIR__ . '/../src/Views/pages/bienetre.php';
});
Router::get('/abonnements', function () {
    require __DIR__ . '/../src/Views/pages/abonnements.php';
});

Router::get('/pages/contact', 'ContactController@index');
Router::post('/pages/contact', 'ContactController@index');
Router::get('/carriere', 'CarriereController@index');
Router::post('/carriere', 'CarriereController@index');
Router::get('/temoignages', 'TemoignageController@index');

Router::get('/pages/legal', function () {
    require __DIR__ . '/../src/Views/pages/legal.php';
});
Router::get('/pages/privacy', function () {
    require __DIR__ . '/../src/Views/pages/privacy.php';
});
Router::get('/pages/terms', function () {
    require __DIR__ . '/../src/Views/pages/terms.php';
});
