<?php

namespace App\Controllers;

use App\Repositories\SalleRepository;
use App\Security\Input;

class SalleController extends BaseController
{
    private SalleRepository $salleRepository;

    public function __construct()
    {
        $this->salleRepository = new SalleRepository();
    }

    public function index()
    {
        $ville = Input::string($_GET, 'ville', 120);

        if ($ville === '') {
            $salles = $this->salleRepository->getAll();
        } else {
            $salles = $this->salleRepository->findByVille($ville);
        }

        $this->render('salles/index', ['salles' => $salles, 'ville' => $ville]);
    }

    public function show()
    {
        $id = Input::int($_GET, 'id', 0);
        $salle = $this->salleRepository->findById($id);
        $this->render('salles/show', ['salle' => $salle]);
    }
}
