<?php

namespace App\Controllers;

use App\Models\CandidatureModel;
use App\Core\Csrf;

class CarriereController extends BaseController
{
    private $candidatureModel;
    private $csrf;

    public function __construct()
    {
        $this->candidatureModel = new CandidatureModel();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $success = false;
        $erreur  = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $nom       = trim($_POST['nom'] ?? '');
                $email     = trim($_POST['email'] ?? '');
                $telephone = trim($_POST['telephone'] ?? '');
                $poste     = trim($_POST['poste'] ?? '');
                $message   = trim($_POST['message'] ?? '');

                if ($nom && $email && $message) {
                    $this->candidatureModel->create($nom, $email, $telephone, $poste, $message);
                    $success = true;
                } else {
                    $erreur = "Tous les champs obligatoires doivent être remplis.";
                }
            } else {
                $erreur = "Token invalide.";
            }
        }

        $this->render('pages/carriere', [
            'success'    => $success,
            'erreur'     => $erreur,
            'csrf_token' => $this->csrf->generate()
        ]);
    }
}