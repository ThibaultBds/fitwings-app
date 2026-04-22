<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\ProgrammeService;
use App\Security\Input;

class ProgrammeController extends BaseController
{
    private ProgrammeService $programmeService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->programmeService = new ProgrammeService();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $objectif = Input::string($_GET, 'objectif', 120);
        $niveau = Input::string($_GET, 'niveau', 120);

        $programmes = $this->programmeService->listProgrammes($objectif, $niveau);

        $this->render('programmes/index', [
            'programmes' => $programmes,
            'selectedObjectif' => $objectif,
            'selectedNiveau' => $niveau,
        ]);
    }

    public function show()
    {
        $id = Input::int($_GET, 'id', 0);
        $userId = $_SESSION['user']['id'] ?? null;
        $detail = $this->programmeService->getProgrammeDetail($id, $userId ? (int) $userId : null);

        $this->render('programmes/show', [
            'programme' => $detail['programme'],
            'alreadyEnrolled' => $detail['alreadyEnrolled'],
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

        $this->programmeService->enroll((int) $_SESSION['user']['id'], $id);
        $this->redirect('/programmes/show?id=' . $id);
    }
}
