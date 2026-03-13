<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\TemoignageRepository;
use App\Security\Input;

class ModeratorController extends BaseController
{
    private TemoignageRepository $temoignageRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->temoignageRepository = new TemoignageRepository();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $this->render('moderator/index', [
            'temoignages_attente' => $this->temoignageRepository->getEnAttente(),
            'csrf_token' => $this->csrf->generate(),
        ]);
    }

    public function moderer()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/moderator');
        }

        $id = Input::int($_POST, 'id', 0);
        $statut = Input::string($_POST, 'statut', 20);

        if ($id <= 0 || !Input::oneOf($statut, ['approuve', 'refuse'])) {
            $this->redirect('/moderator');
        }

        $this->temoignageRepository->updateStatut($id, $statut);
        $this->redirect('/moderator');
    }
}
