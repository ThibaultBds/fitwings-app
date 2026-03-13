<?php

namespace App\Repositories;

use App\Models\ReservationModel;

class ReservationRepository extends BaseRepository
{
    public function create(string $nom, string $email, string $cours, string $message): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO reservations (nom, email, cours, message)
            VALUES (:nom, :email, :cours, :message)
        ");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'cours' => $cours,
            'message' => $message,
        ]);
    }

    public function findAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM reservations ORDER BY id DESC");
        $stmt->execute();

        return $this->toObjects($stmt->fetchAll(), ReservationModel::class);
    }
}
