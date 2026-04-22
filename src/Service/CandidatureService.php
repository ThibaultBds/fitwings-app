<?php

namespace App\Service;

use App\Repositories\CandidatureRepository;

class CandidatureService
{
    private CandidatureRepository $candidatureRepository;

    public function __construct(?CandidatureRepository $candidatureRepository = null)
    {
        $this->candidatureRepository = $candidatureRepository ?? new CandidatureRepository();
    }

    public function submit(string $nom, string $email, string $telephone, string $message): array
    {
        if ($nom !== '' && $email !== '' && $message !== '') {
            $this->candidatureRepository->create($nom, $email, $telephone, '', $message);
            return ['success' => true, 'error' => ''];
        }

        return ['success' => false, 'error' => 'Tous les champs obligatoires doivent être remplis.'];
    }
}
