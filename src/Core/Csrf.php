<?php

namespace App\Core;

class Csrf
{
    public function generate(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    public function verify(string $token): bool
    {
        if (!isset($_SESSION['csrf_token'])) {
            return false;
        }

        $valid = hash_equals($_SESSION['csrf_token'], $token);

        if ($valid) {
            unset($_SESSION['csrf_token']);
        }

        return $valid;
    }
}