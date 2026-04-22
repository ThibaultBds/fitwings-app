<?php

namespace App\Service;

use App\Repositories\ProgrammeRepository;
use App\Repositories\UserProgrammeRepository;

class ProgrammeService
{
    private ProgrammeRepository $programmeRepository;
    private UserProgrammeRepository $userProgrammeRepository;

    public function __construct(
        ?ProgrammeRepository $programmeRepository = null,
        ?UserProgrammeRepository $userProgrammeRepository = null
    ) {
        $this->programmeRepository = $programmeRepository ?? new ProgrammeRepository();
        $this->userProgrammeRepository = $userProgrammeRepository ?? new UserProgrammeRepository();
    }

    public function listProgrammes(string $objectif, string $niveau): array
    {
        if ($objectif === '' && $niveau === '') {
            return $this->programmeRepository->getAll();
        }

        return $this->programmeRepository->getFiltered($objectif, $niveau);
    }

    public function getProgrammeDetail(int $programmeId, ?int $userId = null): array
    {
        $programme = $this->programmeRepository->findById($programmeId);
        $alreadyEnrolled = false;

        if ($userId !== null) {
            $alreadyEnrolled = $this->userProgrammeRepository->isEnrolled($userId, $programmeId);
        }

        return [
            'programme' => $programme,
            'alreadyEnrolled' => $alreadyEnrolled,
        ];
    }

    public function enroll(int $userId, int $programmeId): bool
    {
        if ($userId <= 0 || $programmeId <= 0) {
            return false;
        }

        $this->userProgrammeRepository->add($userId, $programmeId);
        return true;
    }
}
