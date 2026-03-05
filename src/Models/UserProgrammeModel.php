<?php 

namespace App\Models;

class UserProgrammeModel extends BaseModel {
    public function getByUserId(int $userId)
    {
        $stmt = $this->db->prepare("
            SELECT p.*, pu.statut, pu.id AS pivot_id
            FROM programme_utilisateur pu
            JOIN programme p ON p.id = pu.programme_id
            WHERE pu.user_id = :user_id
        ");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll();
    }

    public function add(int $userId, int $programmeId)
    {
        $stmt = $this->db->prepare("
            INSERT IGNORE INTO programme_utilisateur (user_id, programme_id)
            VALUES (:user_id, :programme_id)
        ");
        $stmt->execute(['user_id' => $userId, 'programme_id' => $programmeId]);
    }
}