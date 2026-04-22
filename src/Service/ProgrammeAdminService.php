<?php

namespace App\Service;

use App\Repositories\ProgrammeRepository;

class ProgrammeAdminService
{
    private ProgrammeRepository $programmeRepository;

    public function __construct(?ProgrammeRepository $programmeRepository = null)
    {
        $this->programmeRepository = $programmeRepository ?? new ProgrammeRepository();
    }

    public function createProgramme(
        string $title,
        string $description,
        string $niveau,
        string $objectif,
        array $details
    ): bool {
        if ($title === '' || $description === '') {
            return false;
        }

        $this->programmeRepository->create($title, $description, $niveau, $objectif, $details);
        return true;
    }

    public function updateProgramme(
        int $id,
        string $title,
        string $description,
        string $niveau,
        string $objectif,
        array $details
    ): bool {
        if ($id <= 0 || $title === '' || $description === '') {
            return false;
        }

        $this->programmeRepository->update($id, $title, $description, $niveau, $objectif, $details);
        return true;
    }

    public function deleteProgramme(int $id): bool
    {
        if ($id <= 0) {
            return false;
        }

        $this->programmeRepository->delete($id);
        return true;
    }
}
