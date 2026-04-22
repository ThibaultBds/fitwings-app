<?php

namespace App\Service;

use App\Repositories\UserProgrammeRepository;

class UserProgrammeService
{
    private UserProgrammeRepository $userProgrammeRepository;

    public function __construct(?UserProgrammeRepository $userProgrammeRepository = null)
    {
        $this->userProgrammeRepository = $userProgrammeRepository ?? new UserProgrammeRepository();
    }

    public function getUserProgrammes(int $userId): array
    {
        return $this->userProgrammeRepository->getByUserId($userId);
    }

    public function unsubscribe(int $userId, int $programmeId): void
    {
        if ($programmeId > 0) {
            $this->userProgrammeRepository->remove($userId, $programmeId);
        }
    }
}
