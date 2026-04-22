<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\AdminDashboardService;
use App\Service\ProgrammeAdminService;
use App\Service\SalleAdminService;
use App\Service\TemoignageModerationService;
use App\Service\UserAdminService;
use App\Security\Input;

class AdminController extends BaseController
{
    private AdminDashboardService $dashboardService;
    private UserAdminService $userAdminService;
    private ProgrammeAdminService $programmeAdminService;
    private SalleAdminService $salleAdminService;
    private TemoignageModerationService $temoignageModerationService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->dashboardService = new AdminDashboardService();
        $this->userAdminService = new UserAdminService();
        $this->programmeAdminService = new ProgrammeAdminService();
        $this->salleAdminService = new SalleAdminService();
        $this->temoignageModerationService = new TemoignageModerationService();
        $this->csrf = new Csrf();
    }

    private function requireCsrf(): void
    {
        if (!$this->csrf->verify($_POST['csrf_token'] ?? '')) {
            $this->redirect('/admin');
        }
    }

    public function index(): void
    {
        $data = $this->dashboardService->getDashboardData();
        $data['csrf_token'] = $this->csrf->generate();

        $this->render('admin/index', $data);
    }

    public function modererTemoignage(): void
    {
        $this->requireCsrf();

        $id = Input::int($_POST, 'id', 0);
        $statut = Input::string($_POST, 'statut', 20);
        $updated = $this->temoignageModerationService->updateStatus(
            $id,
            $statut,
            ['en_attente', 'approuve', 'refuse']
        );
        if (!$updated) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function updateRole(): void
    {
        $this->requireCsrf();

        $roleId = Input::int($_POST, 'role_id', 0);
        $newRole = Input::string($_POST, 'new_role', 20);

        $updated = $this->userAdminService->updateRole((int) $_SESSION['user']['id'], $roleId, $newRole);
        if (!$updated) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function deleteUser(): void
    {
        $this->requireCsrf();

        $deleteId = Input::int($_POST, 'delete_id', 0);
        $deleted = $this->userAdminService->deleteUser((int) $_SESSION['user']['id'], $deleteId);
        if (!$deleted) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function createUser(): void
    {
        $this->requireCsrf();

        $username = Input::string($_POST, 'username', 120);
        $email = Input::email($_POST, 'email');
        $password = (string)($_POST['password'] ?? '');
        $role = Input::string($_POST, 'role', 20);

        $created = $this->userAdminService->createUser($username, $email, $password, $role);
        if (!$created) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function createProgramme(): void
    {
        $this->requireCsrf();

        $title = Input::string($_POST, 'title', 120);
        $description = Input::string($_POST, 'description', 5000);
        $niveau = Input::string($_POST, 'niveau', 60);
        $objectif = Input::string($_POST, 'objectif', 120);

        $details = [
            'duree_semaines' => ($value = Input::int($_POST, 'duree_semaines', 0)) > 0 ? $value : null,
            'seances_par_semaine' => Input::string($_POST, 'seances_par_semaine', 50),
            'duree_seance_minutes' => ($value = Input::int($_POST, 'duree_seance_minutes', 0)) > 0 ? $value : null,
            'materiel' => Input::string($_POST, 'materiel', 1000),
            'structure_plan' => Input::string($_POST, 'structure_plan', 3000),
            'conseils' => Input::string($_POST, 'conseils', 3000),
            'benefices' => Input::string($_POST, 'benefices', 3000),
        ];

        $created = $this->programmeAdminService->createProgramme($title, $description, $niveau, $objectif, $details);
        if (!$created) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function updateProgramme(): void
    {
        $this->requireCsrf();

        $id = Input::int($_POST, 'id', 0);
        $title = Input::string($_POST, 'title', 120);
        $description = Input::string($_POST, 'description', 5000);
        $niveau = Input::string($_POST, 'niveau', 60);
        $objectif = Input::string($_POST, 'objectif', 120);

        $details = [
            'duree_semaines' => ($value = Input::int($_POST, 'duree_semaines', 0)) > 0 ? $value : null,
            'seances_par_semaine' => Input::string($_POST, 'seances_par_semaine', 50),
            'duree_seance_minutes' => ($value = Input::int($_POST, 'duree_seance_minutes', 0)) > 0 ? $value : null,
            'materiel' => Input::string($_POST, 'materiel', 1000),
            'structure_plan' => Input::string($_POST, 'structure_plan', 3000),
            'conseils' => Input::string($_POST, 'conseils', 3000),
            'benefices' => Input::string($_POST, 'benefices', 3000),
        ];

        $updated = $this->programmeAdminService->updateProgramme(
            $id,
            $title,
            $description,
            $niveau,
            $objectif,
            $details
        );
        if (!$updated) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function deleteProgramme(): void
    {
        $this->requireCsrf();

        $programmeId = Input::int($_POST, 'delete_programme', 0);
        $deleted = $this->programmeAdminService->deleteProgramme($programmeId);
        if (!$deleted) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function createSalle(): void
    {
        $this->requireCsrf();

        $nom = Input::string($_POST, 'nom', 120);
        $ville = Input::string($_POST, 'ville', 120);
        $adresse = Input::string($_POST, 'adresse', 255);
        $codePostal = Input::string($_POST, 'code_postal', 20);
        $telephone = Input::string($_POST, 'telephone', 30);
        $email = Input::email($_POST, 'email');
        $horaires = Input::string($_POST, 'horaires', 120);
        $description = Input::string($_POST, 'description', 2000);

        $created = $this->salleAdminService->createSalle(
            $nom,
            $ville,
            $adresse,
            $codePostal,
            $telephone,
            $email,
            $horaires,
            $description
        );
        if (!$created) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function updateSalle(): void
    {
        $this->requireCsrf();

        $id = Input::int($_POST, 'id', 0);
        $nom = Input::string($_POST, 'nom', 120);
        $ville = Input::string($_POST, 'ville', 120);
        $adresse = Input::string($_POST, 'adresse', 255);
        $codePostal = Input::string($_POST, 'code_postal', 20);
        $telephone = Input::string($_POST, 'telephone', 30);
        $email = Input::email($_POST, 'email');
        $horaires = Input::string($_POST, 'horaires', 120);
        $description = Input::string($_POST, 'description', 2000);

        $updated = $this->salleAdminService->updateSalle(
            $id,
            $nom,
            $ville,
            $adresse,
            $codePostal,
            $telephone,
            $email,
            $horaires,
            $description
        );
        if (!$updated) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }

    public function deleteSalle(): void
    {
        $this->requireCsrf();

        $id = Input::int($_POST, 'delete_salle', 0);
        $deleted = $this->salleAdminService->deleteSalle($id);
        if (!$deleted) {
            $this->redirect('/admin');
        }
        $this->redirect('/admin');
    }
}
