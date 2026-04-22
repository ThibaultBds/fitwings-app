<?php

namespace App\Service;

use App\Repositories\SalleRepository;

class SalleService
{
    private SalleRepository $salleRepository;

    public function __construct(?SalleRepository $salleRepository = null)
    {
        $this->salleRepository = $salleRepository ?? new SalleRepository();
    }

    public function listSalles(string $ville): array
    {
        if ($ville === '') {
            return $this->salleRepository->getAll();
        }

        return $this->salleRepository->findByVille($ville);
    }

    public function getSalle(int $id)
    {
        return $this->salleRepository->findById($id);
    }
}
