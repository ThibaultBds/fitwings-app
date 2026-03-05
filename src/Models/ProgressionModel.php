<?php

namespace App\Models;

Class ProgressionModel extends BaseModel {
    public function getByUserId(int $userId) {
        $stmt = $this->db->prepare("SELECT * FROM progression WHERE user_id = :user_id ORDER BY date_suivi DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function create (int $userId, float $poids, float $tourTaille, int $nbSeances) {
        $stmt = $this->db->prepare("INSERT INTO progression (user_id, poids, tour_taille, nombre_seances, date_suivi) VALUES (:user_id, :poids, :tour_taille, :nombre_seances, NOW())");
        $stmt->execute([
        'user_id' => $userId,
        'poids' => $poids,
        'tour_taille' => $tourTaille,
        'nombre_seances' => $nbSeances
        ]);
    }
}