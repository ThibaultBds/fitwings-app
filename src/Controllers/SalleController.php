<?php

namespace App\Controllers;

use App\Models\SalleModel;

class SalleController extends BaseController
{
    private $salleModel;

    public function __construct()
    {
        $this->salleModel = new SalleModel();
    }

    public function index()
    {
        $salles = [];
        $ville = trim($_GET['ville'] ?? '');
        if ($ville !== '') {
            $salles = $this->salleModel->findByVille($ville);
        }
        $this->render('salles/index', ['salles' => $salles, 'ville' => $ville]);
    }

    public function show() {
        $id = (int)($_GET['id'] ?? 0);
        $salle = $this->salleModel->findById($id);
        $this->render('salles/show', ['salle' => $salle]);
    }
}
