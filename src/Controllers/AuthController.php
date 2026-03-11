<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Security\Secu;

class AuthController extends BaseController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = Secu::getEmail($_POST, 'email');
            $password = (string)($_POST['password'] ?? '');

            if ($email === '' || $password === '') {
                $error = "Tous les champs sont obligatoires.";
                $this->render('auth/login', ['error' => $error]);
                return;
            }

            $user = $this->userRepository->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'] ?? 'user',
                ];

                $this->redirect('/account');
            }

            $this->render('auth/login', ['error' => 'Identifiants invalides.']);
            return;
        }

        $this->render('auth/login');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = Secu::getString($_POST, 'username', 120);
            $email    = Secu::getEmail($_POST, 'email');
            $password = (string) ($_POST['password'] ?? '');

            if ($username === '' || $password === '') {
                $this->render('auth/register', ['error' => 'Tous les champs sont obligatoires.']);
                return;
            }

            if ($email === '') {
                $this->render('auth/register', ['error' => 'Email invalide.']);
                return;
            }

            if (strlen($password) < 8) {
                $this->render('auth/register', ['error' => 'Mot de passe trop court (8 caractères minimum).']);
                return;
            }

            if ($this->userRepository->findByEmail($email)) {
                $this->render('auth/register', ['error' => 'Email déjà utilisé.']);
                return;
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

            $this->redirect('/account');
        }

        $this->render('auth/register');
    }

    public function logout()
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
        $this->redirect('/');
    }
}
