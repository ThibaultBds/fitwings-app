<?php

namespace App\Service;

use App\Repositories\TemoignageRepository;

class TemoignageModerationService
{
    private TemoignageRepository $temoignageRepository;

    public function __construct(?TemoignageRepository $temoignageRepository = null)
    {
        $this->temoignageRepository = $temoignageRepository ?? new TemoignageRepository();
    }

    public function getPending(): array
    {
        return $this->temoignageRepository->getEnAttente();
    }

    public function updateStatus(int $id, string $statut, array $allowed): bool
    {
        if ($id <= 0 || !in_array($statut, $allowed, true)) {
            return false;
        }

        $this->temoignageRepository->updateStatut($id, $statut);
        return true;
    }
}
