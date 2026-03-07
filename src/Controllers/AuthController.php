<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = "Tous les champs sont obligatoires.";
                $this->render('auth/login', ['error' => $error]);
                return;
            }

            $userModel = new UserModel();
            $user = $userModel->findByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'role' => $user['role'] ?? 'user'
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
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Email invalide.";
                $this->render('auth/register', ['error' => $error]);
                return;
            }
            $password = $_POST['password'] ?? '';
            if (strlen($password) < 8) {
                $error = "Mot de passe invalide.";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            if($username === '' || $email === '' || $password === '') {
                $error = "Tous les champs sont obligatoires.";
                $this->render('auth/register', ['error' => $error]);
                return;
            }

            $userModel = new UserModel();

            if ($userModel->findByEmail($email)) {
                $this->render('auth/register', ['error' => 'Email déjà utilisé.']);
                return;
            }
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $userId = $userModel->create($username, $email, $hashedPassword);

            $_SESSION['user'] = [
                'id' => $userId,
                'username' => $username,
                'email' => $email,
                'role' => 'user'
            ];
            $this->redirect('/account');
        }

        $this->render('auth/register');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/');
    }
}
