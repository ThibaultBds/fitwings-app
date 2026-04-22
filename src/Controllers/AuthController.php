<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\AuthService;
use App\Security\Input;

class AuthController extends BaseController
{
    private Csrf $csrf;
    private AuthService $authService;

    public function __construct()
    {
        $this->csrf = new Csrf();
        $this->authService = new AuthService();
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $this->render('auth/login', [
                    'error' => 'La session a expiré. Merci de recommencer.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
                return;
            }

            $email = Input::email($_POST, 'email');
            $password = (string) ($_POST['password'] ?? '');

            $result = $this->authService->attemptLogin($email, $password);
            if ($result['success']) {
                $this->redirect('/account');
            }

            $this->render('auth/login', [
                'error' => $result['error'],
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
                    'error' => 'La session a expiré. Merci de recommencer.',
                    'csrf_token' => $this->csrf->generate(),
                ]);
                return;
            }

            $username = Input::string($_POST, 'username', 120);
            $email = Input::email($_POST, 'email');
            $password = (string) ($_POST['password'] ?? '');

            $result = $this->authService->register($username, $email, $password);
            if ($result['success']) {
                $this->redirect('/account');
            }

            $this->render('auth/register', [
                'error' => $result['error'],
                'csrf_token' => $this->csrf->generate(),
            ]);
            return;
        }

        $this->render('auth/register', ['csrf_token' => $this->csrf->generate()]);
    }

    public function logout(): void
    {
        $this->authService->logout();
        $this->redirect('/');
    }
}
