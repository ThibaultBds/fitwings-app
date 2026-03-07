<?php 

namespace App\Models;
use App\Models\BaseModel;

class ReservationModel extends BaseModel {
    public function create(string $nom, string $email, string $cours, string $message) {
        $stmt = $this->db->prepare("
            INSERT INTO reservations (nom, email, cours, message)
            VALUES (:nom, :email, :cours, :message)
        ");
        $stmt->execute(['nom' => $nom, 'email' => $email, 'cours' => $cours, 'message' => $message]);
    }
}