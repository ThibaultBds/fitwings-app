<?php

namespace App\Service;

use App\Repositories\ProgressionRepository;
use App\Repositories\UserRepository;

class AccountService
{
    private UserRepository $userRepository;
    private ProgressionRepository $progressionRepository;

    public function __construct(
        ?UserRepository $userRepository = null,
        ?ProgressionRepository $progressionRepository = null
    ) {
        $this->userRepository = $userRepository ?? new UserRepository();
        $this->progressionRepository = $progressionRepository ?? new ProgressionRepository();
    }

    public function getAccountData(int $userId): array
    {
        $user = $this->userRepository->findById($userId);
        $progressions = $user ? $this->progressionRepository->getByUserId($user->id) : [];

        return [
            'user' => $user,
            'progressions' => $progressions,
        ];
    }

    public function recordProgression(int $userId, float $poids, float $tourTaille, int $nbSeances): bool
    {
        if ($poids <= 0 || $tourTaille <= 0 || $nbSeances < 0) {
            return false;
        }

        $this->progressionRepository->create($userId, $poids, $tourTaille, $nbSeances);
        return true;
    }
}
