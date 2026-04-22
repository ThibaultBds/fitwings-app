<?php

namespace App\Service;

use App\Repositories\TemoignageRepository;

class TemoignageService
{
    private TemoignageRepository $temoignageRepository;

    public function __construct(?TemoignageRepository $temoignageRepository = null)
    {
        $this->temoignageRepository = $temoignageRepository ?? new TemoignageRepository();
    }

    public function submit(?int $userId, int $note, string $contenu): array
    {
        if (!$userId) {
            return ['success' => false, 'error' => 'Vous devez être connecté pour publier un témoignage.'];
        }

        if ($note >= 1 && $note <= 5 && $contenu !== '') {
            $this->temoignageRepository->create($userId, $note, $contenu);
            return ['success' => true, 'error' => ''];
        }

        return ['success' => false, 'error' => 'Tous les champs doivent être remplis.'];
    }

    public function getApproved(): array
    {
        return $this->temoignageRepository->getApprouves();
    }
}
