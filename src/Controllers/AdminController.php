<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\ProgrammeRepository;
use App\Repositories\SalleRepository;
use App\Repositories\TemoignageRepository;
use App\Repositories\UserRepository;
use App\Security\Input;

class AdminController extends BaseController
{
    private TemoignageRepository $temoignageRepository;
    private UserRepository $userRepository;
    private ProgrammeRepository $programmeRepository;
    private SalleRepository $salleRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->temoignageRepository = new TemoignageRepository();
        $this->userRepository = new UserRepository();
        $this->programmeRepository = new ProgrammeRepository();
        $this->salleRepository = new SalleRepository();
        $this->csrf = new Csrf();
    }

    public function index(): void
    {
        $this->render('admin/index', [
            'temoignages_attente' => $this->temoignageRepository->getEnAttente(),
            'users' => $this->userRepository->findAll(),
            'programmes' => $this->programmeRepository->getAll(),
            'salles' => $this->salleRepository->getAll(),
            'csrf_token' => $this->csrf->generate(),
        ]);
    }

    public function modererTemoignage(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $id = Input::int($_POST, 'id', 0);
        $statut = Input::string($_POST, 'statut', 20);
        if ($id <= 0 || !Input::oneOf($statut, ['en_attente', 'approuve', 'refuse'])) {
            $this->redirect('/admin');
        }

        $this->temoignageRepository->updateStatut($id, $statut);
        $this->redirect('/admin');
    }

    public function updateRole(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $roleId = Input::int($_POST, 'role_id', 0);
        $newRole = Input::string($_POST, 'new_role', 20);

        if ($roleId <= 0 || (int)$_SESSION['user']['id'] === $roleId) {
            $this->redirect('/admin');
        }
        if (!Input::oneOf($newRole, ['user', 'moderateur', 'admin'])) {
            $this->redirect('/admin');
        }

        $this->userRepository->updateRole($roleId, $newRole);
        $this->redirect('/admin');
    }

    public function deleteUser(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $deleteId = Input::int($_POST, 'delete_id', 0);
        if ($deleteId <= 0 || (int)$_SESSION['user']['id'] === $deleteId) {
            $this->redirect('/admin');
        }

        $this->userRepository->delete($deleteId);
        $this->redirect('/admin');
    }

    public function createUser(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $username = Input::string($_POST, 'username', 120);
        $email = Input::email($_POST, 'email');
        $password = (string)($_POST['password'] ?? '');
        $role = Input::string($_POST, 'role', 20);

        if ($username === '' || $email === '' || $password === '' || strlen($password) < 8) {
            $this->redirect('/admin');
        }
        if (!Input::oneOf($role, ['user', 'moderateur', 'admin'])) {
            $this->redirect('/admin');
        }
        if ($this->userRepository->findByEmail($email)) {
            $this->redirect('/admin');
        }

        $this->userRepository->createByAdmin($username, $email, password_hash($password, PASSWORD_DEFAULT), $role);
        $this->redirect('/admin');
    }

    public function createProgramme(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $title = Input::string($_POST, 'title', 120);
        $description = Input::string($_POST, 'description', 5000);
        $niveau = Input::string($_POST, 'niveau', 60);
        $objectif = Input::string($_POST, 'objectif', 120);

        if ($title === '' || $description === '') {
            $this->redirect('/admin');
        }

        $details = [
            'duree_semaines' => ($value = Input::int($_POST, 'duree_semaines', 0)) > 0 ? $value : null,
            'seances_par_semaine' => Input::string($_POST, 'seances_par_semaine', 50),
            'duree_seance_minutes' => ($value = Input::int($_POST, 'duree_seance_minutes', 0)) > 0 ? $value : null,
            'materiel' => Input::string($_POST, 'materiel', 1000),
            'structure_plan' => Input::string($_POST, 'structure_plan', 3000),
            'conseils' => Input::string($_POST, 'conseils', 3000),
            'benefices' => Input::string($_POST, 'benefices', 3000),
        ];

        $this->programmeRepository->create($title, $description, $niveau, $objectif, $details);
        $this->redirect('/admin');
    }

    public function updateProgramme(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $id = Input::int($_POST, 'id', 0);
        $title = Input::string($_POST, 'title', 120);
        $description = Input::string($_POST, 'description', 5000);
        $niveau = Input::string($_POST, 'niveau', 60);
        $objectif = Input::string($_POST, 'objectif', 120);

        if ($id <= 0 || $title === '' || $description === '') {
            $this->redirect('/admin');
        }

        $details = [
            'duree_semaines' => ($value = Input::int($_POST, 'duree_semaines', 0)) > 0 ? $value : null,
            'seances_par_semaine' => Input::string($_POST, 'seances_par_semaine', 50),
            'duree_seance_minutes' => ($value = Input::int($_POST, 'duree_seance_minutes', 0)) > 0 ? $value : null,
            'materiel' => Input::string($_POST, 'materiel', 1000),
            'structure_plan' => Input::string($_POST, 'structure_plan', 3000),
            'conseils' => Input::string($_POST, 'conseils', 3000),
            'benefices' => Input::string($_POST, 'benefices', 3000),
        ];

        $this->programmeRepository->update($id, $title, $description, $niveau, $objectif, $details);
        $this->redirect('/admin');
    }

    public function deleteProgramme(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $programmeId = Input::int($_POST, 'delete_programme', 0);
        if ($programmeId <= 0) {
            $this->redirect('/admin');
        }

        $this->programmeRepository->delete($programmeId);
        $this->redirect('/admin');
    }

    public function createSalle(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $nom = Input::string($_POST, 'nom', 120);
        $ville = Input::string($_POST, 'ville', 120);
        $adresse = Input::string($_POST, 'adresse', 255);
        $codePostal = Input::string($_POST, 'code_postal', 20);
        $telephone = Input::string($_POST, 'telephone', 30);
        $email = Input::email($_POST, 'email');
        $horaires = Input::string($_POST, 'horaires', 120);
        $description = Input::string($_POST, 'description', 2000);

        if ($nom === '' || $ville === '' || $adresse === '') {
            $this->redirect('/admin');
        }

        $this->salleRepository->create($nom, $ville, $adresse, $codePostal, $telephone, $email, $horaires, $description);
        $this->redirect('/admin');
    }

    public function updateSalle(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $id = Input::int($_POST, 'id', 0);
        $nom = Input::string($_POST, 'nom', 120);
        $ville = Input::string($_POST, 'ville', 120);
        $adresse = Input::string($_POST, 'adresse', 255);
        $codePostal = Input::string($_POST, 'code_postal', 20);
        $telephone = Input::string($_POST, 'telephone', 30);
        $email = Input::email($_POST, 'email');
        $horaires = Input::string($_POST, 'horaires', 120);
        $description = Input::string($_POST, 'description', 2000);

        if ($id <= 0 || $nom === '' || $ville === '' || $adresse === '') {
            $this->redirect('/admin');
        }

        $this->salleRepository->update($id, $nom, $ville, $adresse, $codePostal, $telephone, $email, $horaires, $description);
        $this->redirect('/admin');
    }

    public function deleteSalle(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }

        $id = Input::int($_POST, 'delete_salle', 0);
        if ($id <= 0) {
            $this->redirect('/admin');
        }

        $this->salleRepository->delete($id);
        $this->redirect('/admin');
    }
}
