<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\ProgressionRepository;
use App\Repositories\UserRepository;
use App\Security\Secu;

class AccountController extends BaseController
{
    private UserRepository $userRepository;
    private ProgressionRepository $progressionRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->progressionRepository = new ProgressionRepository();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $user = $this->userRepository->findById($_SESSION['user']['id']);
        $progressions = $user ? $this->progressionRepository->getByUserId($user['id']) : [];

        $this->render('auth/account', [
            'user' => $user,
            'progressions' => $progressions,
            'csrf_token' => $this->csrf->generate(),
        ]);
    }

    public function saveProgression()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/account');
        }

        $poids = Secu::getFloat($_POST, 'poids', 0);
        $tourTaille = Secu::getFloat($_POST, 'tour_taille', 0);
        $nbSeances = Secu::getInt($_POST, 'nombre_seances', -1);

        if ($poids <= 0 || $tourTaille <= 0 || $nbSeances < 0) {
            $this->redirect('/account');
        }

        $this->progressionRepository->create($_SESSION['user']['id'], $poids, $tourTaille, $nbSeances);
        $this->redirect('/account');
    }
}
