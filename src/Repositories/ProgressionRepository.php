<?php

namespace App\Repositories;

use App\Models\ProgressionModel;

class ProgressionRepository extends BaseRepository
{
    public function getByUserId(int $userId): array
    {
        $stmt = $this->db->prepare("SELECT * FROM progression WHERE user_id = :user_id ORDER BY date_suivi DESC");
        $stmt->execute(['user_id' => $userId]);

        return $this->toObjects($stmt->fetchAll(), ProgressionModel::class);
    }

    public function create(int $userId, float $poids, float $tourTaille, int $nbSeances): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO progression (user_id, poids, tour_taille, nombre_seances, date_suivi)
            VALUES (:user_id, :poids, :tour_taille, :nombre_seances, NOW())
        ");
        $stmt->execute([
            'user_id' => $userId,
            'poids' => $poids,
            'tour_taille' => $tourTaille,
            'nombre_seances' => $nbSeances,
        ]);
    }
}
