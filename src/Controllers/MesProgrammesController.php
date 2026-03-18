<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\UserProgrammeRepository;
use App\Security\Input;

class MesProgrammesController extends BaseController
{
    private UserProgrammeRepository $userProgrammeRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->userProgrammeRepository = new UserProgrammeRepository();
        $this->csrf = new Csrf();
    }

    public function index(): void
    {
        $programmes = $this->userProgrammeRepository->getByUserId($_SESSION['user']['id']);
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
        if ($programmeId > 0) {
            $this->userProgrammeRepository->remove($_SESSION['user']['id'], $programmeId);
        }

        $this->redirect('/mes-programmes');
    }
}
