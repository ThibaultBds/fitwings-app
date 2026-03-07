<?php

namespace App\Controllers;

use App\Models\TemoignageModel;
use App\Models\UserModel;
use App\Models\ProgrammeModel;
use App\Core\Csrf;

class AdminController extends BaseController
{
    private $temoignageModel;
    private $userModel;
    private $programmeModel;
    private $csrf;

    public function __construct()
    {
        $this->temoignageModel = new TemoignageModel();
        $this->userModel = new UserModel();
        $this->programmeModel = new ProgrammeModel();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $temoignages_attente = $this->temoignageModel->getEnAttente();
        $users = $this->userModel->findAll();
        $programmes = $this->programmeModel->getAll();
        $csrf_token = $this->csrf->generate();
        $this->render('admin/index', [
            'temoignages_attente' => $temoignages_attente,
            'users' => $users,
            'programmes' => $programmes,
            'csrf_token' => $csrf_token,
        ]);
    }

    public function modererTemoignage()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }
        $id = (int)($_POST['id'] ?? 0);
        $statut = $_POST['statut'] ?? '';
        if (!in_array($statut, ['en_attente', 'approuve', 'refuse'], true)) {
                $this->redirect('/admin');
            }
        $this->temoignageModel->updateStatut($id, $statut);
        $this->redirect('/admin');
    }

    public function updateRole()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }
        $role_id = (int)($_POST['role_id'] ?? 0);
        if((int)$_SESSION['user']['id'] === $role_id) {
                $this->redirect('/admin');
            }
        $new_role = (string)($_POST['new_role'] ?? '');

        $role = array("user", "admin");

            if (!in_array($new_role, $role, true))
                {
                $this->redirect('/admin');
                }
        $this->userModel->updateRole($role_id, $new_role);
        $this->redirect('/admin');
    }

    public function deleteUser()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }
        $delete_id = (int)($_POST['delete_id'] ?? 0);
            if((int)$_SESSION['user']['id'] === $delete_id) {
                $this->redirect('/admin');
            }
        $this->userModel->delete($delete_id);
        $this->redirect('/admin');
    }

    public function createProgramme()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $niveau = trim($_POST['niveau'] ?? '');
        $objectif = trim($_POST['objectif'] ?? '');
        $this->programmeModel->create($title, $description, $niveau, $objectif);
        $this->redirect('/admin');
    }

    public function updateProgramme()
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }
        $id = (int)($_POST['id'] ?? 0);
        $title = trim($_POST['title'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $niveau = trim($_POST['niveau'] ?? '');
        $objectif = trim($_POST['objectif'] ?? '');
        $this->programmeModel->update($id, $title, $description, $niveau, $objectif);
        $this->redirect('/admin');
    }

    public function deleteProgramme() {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }
        $delete_programme = (int)($_POST['delete_programme'] ?? 0);
        $this->programmeModel->delete($delete_programme);
        $this->redirect('/admin');
    }
}
