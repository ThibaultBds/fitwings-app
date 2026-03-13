<?php

namespace App\Controllers;

use App\Repositories\UserProgrammeRepository;

class MesProgrammesController extends BaseController
{
    private UserProgrammeRepository $userProgrammeRepository;

    public function __construct()
    {
        $this->userProgrammeRepository = new UserProgrammeRepository();
    }

    public function index()
    {
        $programmes = $this->userProgrammeRepository->getByUserId($_SESSION['user']['id']);
        $this->render('programmes/my-progs', ['programmes' => $programmes]);
    }
}
