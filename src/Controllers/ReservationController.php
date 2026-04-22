<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\ReservationService;
use App\Security\Input;

class ReservationController extends BaseController
{
    private ReservationService $reservationService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->reservationService = new ReservationService();
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

            $result = $this->reservationService->reserve($nom, $email, $cours, $message);
            $success = $result['success'];
            $erreur = $result['error'];
        }

        $this->render('pages/cours', [
            'success' => $success,
            'erreur' => $erreur,
            'csrf_token' => $this->csrf->generate(),
        ]);
    }
}
