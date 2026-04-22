<?php

namespace App\Controllers;

use App\Service\SalleService;
use App\Security\Input;

class SalleController extends BaseController
{
    private SalleService $salleService;

    public function __construct()
    {
        $this->salleService = new SalleService();
    }

    public function index()
    {
        $ville = Input::string($_GET, 'ville', 120);

        $salles = $this->salleService->listSalles($ville);

        $this->render('salles/index', ['salles' => $salles, 'ville' => $ville]);
    }

    public function show()
    {
        $id = Input::int($_GET, 'id', 0);
        $salle = $this->salleService->getSalle($id);
        $this->render('salles/show', ['salle' => $salle]);
    }
}
