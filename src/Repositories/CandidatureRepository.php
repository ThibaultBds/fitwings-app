<?php

namespace App\Repositories;

use App\Models\CandidatureModel;

class CandidatureRepository extends BaseRepository
{
    public function create(string $nom, string $email, string $telephone, string $poste, string $message): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO candidatures (nom, email, telephone, poste, message)
            VALUES (:nom, :email, :telephone, :poste, :message)
        ");
        $stmt->execute([
            'nom' => $nom,
            'email' => $email,
            'telephone' => $telephone,
            'poste' => $poste,
            'message' => $message,
        ]);
    }

    public function findAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM candidatures ORDER BY id DESC");
        $stmt->execute();

        return $this->toObjects($stmt->fetchAll(), CandidatureModel::class);
    }
}
