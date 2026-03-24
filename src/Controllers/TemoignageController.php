<?php

namespace App\Controllers;

use App\Core\Csrf;
use App\Repositories\TemoignageRepository;
use App\Security\Input;

class TemoignageController extends BaseController
{
    private TemoignageRepository $temoignageRepository;
    private Csrf $csrf;

    public function __construct()
    {
        $this->temoignageRepository = new TemoignageRepository();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $success = false;
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['user']['id'])) {
                $erreur = "Vous devez être connecté pour publier un témoignage.";
            } elseif ($this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $note = Input::int($_POST, 'note', 0);
                $contenu = Input::string($_POST, 'contenu', 300);

                if ($note >= 1 && $note <= 5 && $contenu) {
                    $this->temoignageRepository->create($_SESSION['user']['id'], $note, $contenu);
                    $success = true;
                } else {
                    $erreur = "Tous les champs doivent être remplis.";
                }
            } else {
                $erreur = "Token invalide.";
            }
        }

        $temoignages = $this->temoignageRepository->getApprouves();

        $this->render('pages/temoignages', [
            'success' => $success,
            'erreur' => $erreur,
            'csrf_token' => $this->csrf->generate(),
            'temoignages' => $temoignages,
        ]);
    }
}
