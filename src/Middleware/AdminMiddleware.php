<?php

namespace App\Middleware;

class AdminMiddleware
{
    public function handle(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        if ($_SESSION['user']['role'] !== 'admin') {
            header('Location: /');
            exit;
        }
    }
}