<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\TemoignageModerationService;
use App\Security\Input;

class ModeratorController extends BaseController
{
    private TemoignageModerationService $temoignageModerationService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->temoignageModerationService = new TemoignageModerationService();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $this->render('moderator/index', [
            'temoignages_attente' => $this->temoignageModerationService->getPending(),
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

        $updated = $this->temoignageModerationService->updateStatus($id, $statut, ['approuve', 'refuse']);
        if (!$updated) {
            $this->redirect('/moderator');
        }
        $this->redirect('/moderator');
    }
}
