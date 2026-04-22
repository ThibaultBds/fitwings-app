<?php

namespace App\Service;

use App\Repositories\SalleRepository;

class SalleAdminService
{
    private SalleRepository $salleRepository;

    public function __construct(?SalleRepository $salleRepository = null)
    {
        $this->salleRepository = $salleRepository ?? new SalleRepository();
    }

    public function createSalle(
        string $nom,
        string $ville,
        string $adresse,
        string $codePostal,
        string $telephone,
        string $email,
        string $horaires,
        string $description
    ): bool {
        if ($nom === '' || $ville === '' || $adresse === '') {
            return false;
        }

        $this->salleRepository->create(
            $nom,
            $ville,
            $adresse,
            $codePostal,
            $telephone,
            $email,
            $horaires,
            $description
        );
        return true;
    }

    public function updateSalle(
        int $id,
        string $nom,
        string $ville,
        string $adresse,
        string $codePostal,
        string $telephone,
        string $email,
        string $horaires,
        string $description
    ): bool {
        if ($id <= 0 || $nom === '' || $ville === '' || $adresse === '') {
            return false;
        }

        $this->salleRepository->update(
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
        return true;
    }

    public function deleteSalle(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        $this->salleRepository->delete($id);
        return true;
    }
}
