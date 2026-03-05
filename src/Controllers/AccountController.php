<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ProgressionModel;

class AccountController extends BaseController
{

    public function index()
    {
        $userModel = new UserModel();
        $user = $userModel->findByEmail($_SESSION['user']['email']);

        $progressionModel = new ProgressionModel();
        $progressions = $progressionModel->getByUserId($user['id']);

        $this->render('auth/account', ['user' => $user, 'progressions' => $progressions]);
    }

    public function saveProgression() {
        $poids = (float)($_POST['poids'] ?? 0);
        $tourTaille = (float)($_POST['tour_taille'] ?? 0);
        $nbSeances = (int)($_POST['nombre_seances'] ?? 0);

        $progressionModel = new ProgressionModel();
        $progressionModel->create($_SESSION['user']['id'], $poids, $tourTaille, $nbSeances);

        $this->redirect('/account');
    }
}
