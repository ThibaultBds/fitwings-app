<?php

namespace App\Controllers;

use App\Models\CandidatureModel;

class CarriereController extends BaseController
{
    private $candidatureModel;

        public function __construct() 
        {
            $this->candidatureModel = new CandidatureModel();
        }

        public function index() {
            $success = false;
            $erreur = '';
            
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom     = htmlspecialchars(trim($_POST['nom'] ?? ''));
            $email   = htmlspecialchars(trim($_POST['email'] ?? ''));
            $telephone = htmlspecialchars(trim($_POST['telephone'] ?? ''));
            $poste = htmlspecialchars(trim($_POST['poste'] ?? ''));
            $message = htmlspecialchars(trim($_POST['message'] ?? ''));

            if ($nom && $email && $message) {
                $success = true;
                $this->candidatureModel->create($nom, $email, $telephone, $poste, $message);
            } else {
                $erreur = "Tous les champs obligatoires doivent être remplis.";
            }
        }
        $this->render('pages/carriere', ['success' => $success, 'erreur' => $erreur]);

    }
}
