<?php

namespace App\Models;

use App\Models\BaseModel;

class SalleModel extends BaseModel {
    public function findById (int $id) {
        $stmt = $this->db->prepare("SELECT * FROM salle WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function findByVille(string $ville) {
        $stmt = $this->db->prepare("SELECT * FROM salle WHERE ville LIKE :ville ORDER BY nom");
        $stmt->execute(['ville' => '%' . $ville . '%']);
        return $stmt->fetchAll();
    }
}