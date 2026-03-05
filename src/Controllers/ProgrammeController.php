<?php

namespace App\Controllers;

use App\Models\ProgrammeModel;
use App\Models\UserProgrammeModel;

class ProgrammeController extends BaseController {
    private $programmeModel;
    private $userProgrammeModel;

    public function __construct() {
        $this->programmeModel = new ProgrammeModel();
        $this->userProgrammeModel = new UserProgrammeModel();
         }

    public function index() {
        $programmes = $this->programmeModel->getAll();
        $this->render('programmes/index', ['programmes' => $programmes]);
    }

    public function show() {
    $id = (int)($_GET['id'] ?? 0);
    $programme = $this->programmeModel->findById($id);
    
    $alreadyEnrolled = false;
    if (isset($_SESSION['user'])) {
        $alreadyEnrolled = $this->userProgrammeModel->isEnrolled($_SESSION['user']['id'], $id);
    }

    $this->render('programmes/show', ['programme' => $programme, 'alreadyEnrolled' => $alreadyEnrolled]);
}

    public function inscrire() {
        $id = (int)($_POST['programme_id'] ?? 0);
        $this->userProgrammeModel->add($_SESSION['user']['id'], $id);
        $this->redirect('/programmes/show?id=' . $id);

    }
}
