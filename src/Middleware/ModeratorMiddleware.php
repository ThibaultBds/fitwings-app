<?php

namespace App\Middleware;

class ModeratorMiddleware
{
    public function handle()
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }

        if (!in_array($_SESSION['user']['role'] ?? 'user', ['admin', 'moderateur'], true)) {
            header('Location: /');
            exit;
        }
    }
}
