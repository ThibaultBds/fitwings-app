<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\UserProgrammeService;
use App\Security\Input;

class MesProgrammesController extends BaseController
{
    private UserProgrammeService $userProgrammeService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->userProgrammeService = new UserProgrammeService();
        $this->csrf = new Csrf();
    }

    public function index(): void
    {
        $programmes = $this->userProgrammeService->getUserProgrammes($_SESSION['user']['id']);
        $this->render('programmes/my-progs', [
            'programmes'  => $programmes,
            'csrf_token'  => $this->csrf->generate(),
        ]);
    }

    public function unsubscribe(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/mes-programmes');
            return;
        }

        $programmeId = Input::int($_POST, 'programme_id', 0);
        $this->userProgrammeService->unsubscribe($_SESSION['user']['id'], $programmeId);

        $this->redirect('/mes-programmes');
    }
}
