<?php

namespace App\Service;

use App\Repositories\ReservationRepository;

class ReservationService
{
    private ReservationRepository $reservationRepository;

    public function __construct(?ReservationRepository $reservationRepository = null)
    {
        $this->reservationRepository = $reservationRepository ?? new ReservationRepository();
    }

    public function reserve(string $nom, string $email, string $cours, string $message): array
    {
        if ($nom === '' || $email === '' || $cours === '') {
            return ['success' => false, 'error' => 'Veuillez remplir tous les champs obligatoires.'];
        }

        $this->reservationRepository->create($nom, $email, $cours, $message);
        return ['success' => true, 'error' => ''];
    }
}
