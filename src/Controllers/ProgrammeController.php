<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\ProgrammeRepository;
use App\Repositories\UserProgrammeRepository;
use App\Security\Input;

class ProgrammeController extends BaseController
{
    private ProgrammeRepository $programmeRepository;
    private UserProgrammeRepository $userProgrammeRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->programmeRepository = new ProgrammeRepository();
        $this->userProgrammeRepository = new UserProgrammeRepository();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $objectif = Input::string($_GET, 'objectif', 120);
        $niveau = Input::string($_GET, 'niveau', 120);

        if ($objectif === '' && $niveau === '') {
            $programmes = $this->programmeRepository->getAll();
        } else {
            $programmes = $this->programmeRepository->getFiltered($objectif, $niveau);
        }

        $this->render('programmes/index', [
            'programmes' => $programmes,
            'selectedObjectif' => $objectif,
            'selectedNiveau' => $niveau,
        ]);
    }

    public function show()
    {
        $id = Input::int($_GET, 'id', 0);
        $programme = $this->programmeRepository->findById($id);

        $alreadyEnrolled = false;
        if (isset($_SESSION['user'])) {
            $alreadyEnrolled = $this->userProgrammeRepository->isEnrolled($_SESSION['user']['id'], $id);
        }

        $this->render('programmes/show', [
            'programme' => $programme,
            'alreadyEnrolled' => $alreadyEnrolled,
            'csrf_token' => $this->csrf->generate(),
        ]);
    }

    public function inscrire()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/programmes');
        }

        $id = Input::int($_POST, 'programme_id', 0);
        if ($id <= 0 || !isset($_SESSION['user']['id'])) {
            $this->redirect('/programmes');
        }

        $this->userProgrammeRepository->add($_SESSION['user']['id'], $id);
        $this->redirect('/programmes/show?id=' . $id);
    }
}
