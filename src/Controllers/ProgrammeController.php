<?php

namespace App\Controllers;

use App\Models\ProgrammeModel;

Class ProgrammeController extends BaseController {
    private $programmeModel;

    public function __construct() {
        $this->programmeModel = new ProgrammeModel();
    }

    public function index() {
        $programmes = $this->programmeModel->getAll();
        $this->render('programmes/index', ['programmes' => $programmes]);
    }

    public function show() {
    $id = (int)($_GET['id'] ?? 0);
    $programme = $this->programmeModel->findById($id);
    $this->render('programmes/show', ['programme' => $programme]);
}
}