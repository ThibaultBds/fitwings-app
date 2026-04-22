<?php

namespace App\Service;

use App\Repositories\UserRepository;

class AuthService
{
    private UserRepository $userRepository;

    public function __construct(?UserRepository $userRepository = null)
    {
        $this->userRepository = $userRepository ?? new UserRepository();
    }

    public function attemptLogin(string $email, string $password): array
    {
        if ($email === '' || $password === '') {
            return ['success' => false, 'error' => 'Tous les champs sont obligatoires.'];
        }

        $user = $this->userRepository->findByEmail($email);

        if ($user && password_verify($password, $user->password)) {
            session_regenerate_id(true);
            $_SESSION['user'] = [
                'id' => $user->id,
                'username' => $user->username,
                'email' => $user->email,
                'role' => $user->role ?? 'user',
            ];

            return ['success' => true, 'error' => ''];
        }

        return ['success' => false, 'error' => 'Identifiants invalides.'];
    }

    public function register(string $username, string $email, string $password): array
    {
        if ($username === '' || $password === '') {
            return ['success' => false, 'error' => 'Tous les champs sont obligatoires.'];
        }

        if ($email === '') {
            return ['success' => false, 'error' => 'Email invalide.'];
        }

        if (strlen($password) < 8) {
            return ['success' => false, 'error' => 'Mot de passe trop court (8 caracteres minimum).'];
        }

        if ($this->userRepository->findByEmail($email)) {
            return ['success' => false, 'error' => 'Email déjà utilisé.'];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $userId = $this->userRepository->create($username, $email, $hashedPassword);

        session_regenerate_id(true);
        $_SESSION['user'] = [
            'id' => $userId,
            'username' => $username,
            'email' => $email,
            'role' => 'user',
        ];

        return ['success' => true, 'error' => ''];
    }

    public function logout(): void
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }

        session_destroy();
    }
}
