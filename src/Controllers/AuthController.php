<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\UserRepository;
use App\Security\Input;

class AuthController extends BaseController
{
    private UserRepository $userRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->csrf = new Csrf();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $this->render('auth/login', [
                    'error' => 'La session a expire. Merci de recommencer.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
                return;
            }

            $email = Input::email($_POST, 'email');
            $password = (string) ($_POST['password'] ?? '');

            if ($email === '' || $password === '') {
                $this->render('auth/login', [
                    'error' => 'Tous les champs sont obligatoires.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
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

            $this->render('auth/login', [
                'error' => 'Identifiants invalides.',
                'csrf_token' => $this->csrf->generate(),
            ]);
            return;
        }

        $this->render('auth/login', ['csrf_token' => $this->csrf->generate()]);
    }

    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $this->render('auth/register', [
                    'error' => 'La session a expire. Merci de recommencer.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
                return;
            }

            $username = Input::string($_POST, 'username', 120);
            $email = Input::email($_POST, 'email');
            $password = (string) ($_POST['password'] ?? '');

            if ($username === '' || $password === '') {
                $this->render('auth/register', [
                    'error' => 'Tous les champs sont obligatoires.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
                return;
            }

            if ($email === '') {
                $this->render('auth/register', [
                    'error' => 'Email invalide.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
                return;
            }

            if (strlen($password) < 8) {
                $this->render('auth/register', [
                    'error' => 'Mot de passe trop court (8 caracteres minimum).',
                    'csrf_token' => $this->csrf->generate(),
                ]);
                return;
            }

            if ($this->userRepository->findByEmail($email)) {
                $this->render('auth/register', [
                    'error' => 'Email deja utilise.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
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

        $this->render('auth/register', ['csrf_token' => $this->csrf->generate()]);
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
        $this->redirect('/');
    }
}
