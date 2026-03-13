<?php

declare(strict_types=1);

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

use App\Core\Router;

require __DIR__ . '/../routes/web.php';

Router::dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
