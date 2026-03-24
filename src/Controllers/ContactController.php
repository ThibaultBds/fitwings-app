<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Security\Input;

class ContactController extends BaseController
{
    private Csrf $csrf;

    public function __construct()
    {
        $this->csrf = new Csrf();
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
                $safeEmail = str_replace(["\r", "\n", "%0a", "%0d"], '', $old['email']);
                $subject = sprintf('Message de %s via Fitwings', $old['nom']);
                $body = "Nom : {$old['nom']}\nEmail : {$old['email']}\n\nMessage :\n{$old['message']}";
                $headers = [
                    'From: noreply@fitwings.fr',
                    'Reply-To: ' . $safeEmail,
                ];

                $success = mail('contact@fitwings.fr', $subject, $body, implode("\r\n", $headers));

                if (!$success) {
                    $error = "Le message n'a pas pu être envoyé pour le moment.";
                } else {
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
