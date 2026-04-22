<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\ContactService;
use App\Security\Input;

class ContactController extends BaseController
{
    private Csrf $csrf;
    private ContactService $contactService;

    public function __construct()
    {
        $this->csrf = new Csrf();
        $this->contactService = new ContactService();
    }

    public function index(): void
    {
        $success = false;
        $error = '';
        $old = [
            'nom' => '',
            'email' => '',
            'message' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old = [
                'nom' => Input::string($_POST, 'nom', 120),
                'email' => Input::email($_POST, 'email'),
                'message' => Input::string($_POST, 'message', 2000),
            ];

            if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $error = 'La session du formulaire a expiré. Réessayez.';
            } elseif ($old['nom'] === '' || $old['email'] === '' || $old['message'] === '') {
                $error = 'Tous les champs sont obligatoires.';
            } else {
                $result = $this->contactService->sendMessage(
                    $old['nom'],
                    $old['email'],
                    $old['message'],
                    $_SERVER['REMOTE_ADDR'] ?? '',
                    $_SERVER['HTTP_USER_AGENT'] ?? ''
                );
                $success = $result['success'];
                $error = $result['error'];

                if ($success) {
                    $old = ['nom' => '', 'email' => '', 'message' => ''];
                }
            }
        }

        $this->render('pages/contact', [
            'success' => $success,
            'error' => $error,
            'old' => $old,
            'csrf_token' => $this->csrf->generate(),
        ]);
    }
}
