<?php
namespace App\Controllers;

use App\Models\UserProgrammeModel;

class MesProgrammesController extends BaseController 
{
    private $userProgrammeModel;

    public function __construct()
    {
        $this->userProgrammeModel = new UserProgrammeModel();
    }

    public function index() 
    {
        $programmes = $this->userProgrammeModel->getByUserId($_SESSION['user']['id']);
        $this->render('programmes/my-progs', ['programmes' => $programmes]);
    }
}