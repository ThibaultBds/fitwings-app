<?php

namespace App\Controllers;

use App\Models\TemoignageModel;
use App\Core\Csrf;

class TemoignageController extends BaseController
{
    private $temoignagesModel;
    private $csrf;

    public function __construct()
    {
        $this->temoignagesModel = new TemoignageModel();
        $this->csrf = new Csrf();
    }

    public function index()
    {
        $success = false;
        $erreur = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->csrf->verify($_POST['csrf_token'] ?? '')) {
                $note = (int)($_POST['note'] ?? '');
                $contenu = trim($_POST['contenu'] ?? '');

                if ($note  >=1 && $note <= 5 && $contenu) {
                    $this->temoignagesModel->create($_SESSION['user']['id'], $note, $contenu);
                    $success = true;
                } else {
                    $erreur = "Tous les champs doivent être remplis.";
                }
            } else {
                $erreur = "Token invalide.";
            }
        }

        $temoignages = $this->temoignagesModel->getApprouves();

        $this->render('pages/temoignages', [
            'success'     => $success,
            'erreur'      => $erreur,
            'csrf_token'  => $this->csrf->generate(),
            'temoignages' => $temoignages,
        ]);
    }
}
