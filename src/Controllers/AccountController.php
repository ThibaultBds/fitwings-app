<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\AccountService;
use App\Security\Input;

class AccountController extends BaseController
{
    private AccountService $accountService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->accountService = new AccountService();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $data = $this->accountService->getAccountData($_SESSION['user']['id']);

        $this->render('auth/account', [
            'user' => $data['user'],
            'progressions' => $data['progressions'],
            'csrf_token' => $this->csrf->generate(),
        ]);
    }

    public function saveProgression()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/account');
        }

        $poids = Input::float($_POST, 'poids', 0);
        $tourTaille = Input::float($_POST, 'tour_taille', 0);
        $nbSeances = Input::int($_POST, 'nombre_seances', -1);

        $this->accountService->recordProgression($_SESSION['user']['id'], $poids, $tourTaille, $nbSeances);
        $this->redirect('/account');
    }
}
