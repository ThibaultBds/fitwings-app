<?php

namespace App\Service;

use App\Repositories\ContactMessageRepository;
use App\Repositories\ProgrammeRepository;
use App\Repositories\SalleRepository;
use App\Repositories\TemoignageRepository;
use App\Repositories\UserRepository;

class AdminDashboardService
{
    private TemoignageRepository $temoignageRepository;
    private UserRepository $userRepository;
    private ProgrammeRepository $programmeRepository;
    private SalleRepository $salleRepository;
    private ContactMessageRepository $contactMessageRepository;

    public function __construct(
        ?TemoignageRepository $temoignageRepository = null,
        ?UserRepository $userRepository = null,
        ?ProgrammeRepository $programmeRepository = null,
        ?SalleRepository $salleRepository = null,
        ?ContactMessageRepository $contactMessageRepository = null
    ) {
        $this->temoignageRepository = $temoignageRepository ?? new TemoignageRepository();
        $this->userRepository = $userRepository ?? new UserRepository();
        $this->programmeRepository = $programmeRepository ?? new ProgrammeRepository();
        $this->salleRepository = $salleRepository ?? new SalleRepository();
        $this->contactMessageRepository = $contactMessageRepository ?? new ContactMessageRepository();
    }

    public function getDashboardData(): array
    {
        return [
            'temoignages_attente' => $this->temoignageRepository->getEnAttente(),
            'users' => $this->userRepository->findAll(),
            'programmes' => $this->programmeRepository->getAll(),
            'salles' => $this->salleRepository->getAll(),
            'contact_messages' => $this->contactMessageRepository->findRecent(50),
            'contact_messages_error' => $this->contactMessageRepository->getLastError(),
        ];
    }
}
