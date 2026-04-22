<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\CandidatureService;
use App\Security\Input;

class CarriereController extends BaseController
{
    private CandidatureService $candidatureService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->candidatureService = new CandidatureService();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $success = false;
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $nom = Input::string($_POST, 'nom', 120);
                $email = Input::email($_POST, 'email');
                $telephone = Input::string($_POST, 'telephone', 30);
                $message = Input::string($_POST, 'message', 2000);

                $result = $this->candidatureService->submit($nom, $email, $telephone, $message);
                $success = $result['success'];
                $erreur = $result['error'];
            } else {
                $erreur = "Token invalide.";
            }
        }

        $this->render('pages/carriere', [
            'success' => $success,
            'erreur' => $erreur,
            'csrf_token' => $this->csrf->generate(),
        ]);
    }
}
