<?php

namespace App\Controllers;

use App\Models\TemoignageModel;
use App\Models\UserModel;

class AdminController extends BaseController
{
    private $temoignageModel;
    private $userModel;

        public function __construct() {
            $this->temoignageModel = new TemoignageModel();
            $this->userModel = new UserModel();
        }

        public function index() {
            $temoignages_attente = $this->temoignageModel->getEnAttente();
            $users = $this->userModel->findAll();
            $this->render('admin/index', [
                'temoignages_attente' => $temoignages_attente,
                'users' => $users,
            ]);
        }

        public function modererTemoignage() {
            $id = (int)($_POST['id'] ?? 0);
            $statut = $_POST['statut'] ?? '';
            $this->temoignageModel->updateStatut($id, $statut);
            $this->redirect('/admin');
        }

        public function updateRole() {
            $role_id = (int)($_POST['role_id'] ?? '');
            $new_role = (string)($_POST['new_role'] ?? '');
            $this->userModel->updateRole($role_id, $new_role);

            return $this->redirect('/admin');
        }

        public function deleteRole() {
            $delete_id = (int)($_POST['delete_id'] ?? '');
            $this->userModel->delete($delete_id);

            return $this->redirect('/admin');
        }
}