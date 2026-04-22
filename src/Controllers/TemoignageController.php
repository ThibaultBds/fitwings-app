<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Service\TemoignageService;
use App\Security\Input;

class TemoignageController extends BaseController
{
    private TemoignageService $temoignageService;
    private Csrf $csrf;

    public function __construct()
    {
        $this->temoignageService = new TemoignageService();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $success = false;
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $note = Input::int($_POST, 'note', 0);
                $contenu = Input::string($_POST, 'contenu', 300);

                $result = $this->temoignageService->submit(
                    $_SESSION['user']['id'] ?? null,
                    $note,
                    $contenu
                );
                $success = $result['success'];
                $erreur = $result['error'];
            } else {
                $erreur = "Token invalide.";
            }
        }

        $temoignages = $this->temoignageService->getApproved();

        $this->render('pages/temoignages', [
            'success' => $success,
            'erreur' => $erreur,
            'csrf_token' => $this->csrf->generate(),
            'temoignages' => $temoignages,
        ]);
    }
}
