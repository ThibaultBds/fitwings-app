<?php

namespace App\Models;

use App\Models\BaseModel;

class CandidatureModel extends BaseModel {
    public function create(string $nom, string $email, string $telephone, string $poste, string $message) {
        $stmt = $this->db->prepare("
            INSERT INTO candidatures (nom, email, telephone, poste, message)
            VALUES (:nom, :email, :telephone, :poste, :message)
        ");
        $stmt->execute(['nom' => $nom, 'email' => $email, 'telephone' => $telephone, 'poste' => $poste, 'message' => $message]);
    }
}