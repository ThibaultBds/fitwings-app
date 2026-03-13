<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\ReservationRepository;
use App\Security\Input;

class ReservationController extends BaseController
{
    private ReservationRepository $reservationRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->reservationRepository = new ReservationRepository();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $success = false;
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $this->redirect('/pages/cours');
            }

            $nom = Input::string($_POST, 'nom', 120);
            $email = Input::email($_POST, 'email');
            $cours = Input::string($_POST, 'cours', 120);
            $message = Input::string($_POST, 'message', 1000);

            if ($nom === '' || $email === '' || $cours === '') {
                $erreur = 'Veuillez remplir tous les champs obligatoires.';
            } else {
                $this->reservationRepository->create($nom, $email, $cours, $message);
                $success = true;
            }
        }

        $this->render('pages/cours', [
            'success' => $success,
            'erreur' => $erreur,
            'csrf_token' => $this->csrf->generate(),
        ]);
    }
}
