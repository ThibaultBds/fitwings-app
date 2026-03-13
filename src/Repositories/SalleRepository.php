<?php

namespace App\Repositories;

use App\Models\SalleModel;

class SalleRepository extends BaseRepository
{
    public function getAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM salle ORDER BY nom");
        $stmt->execute();

        return $this->toObjects($stmt->fetchAll(), SalleModel::class);
    }

    public function findById(int $id): ?SalleModel
    {
        $stmt = $this->db->prepare("SELECT * FROM salle WHERE id = :id");
        $stmt->execute(['id' => $id]);

        return $this->toObject($stmt->fetch() ?: null, SalleModel::class);
    }

    public function findByVille(string $ville): array
    {
        $stmt = $this->db->prepare("SELECT * FROM salle WHERE ville LIKE :ville ORDER BY nom");
        $stmt->execute(['ville' => '%' . $ville . '%']);

        return $this->toObjects($stmt->fetchAll(), SalleModel::class);
    }

    public function create(
        string $nom,
        string $ville,
        string $adresse,
        string $codePostal,
        string $telephone,
        string $email,
        string $horaires,
        string $description
    ): string {
        $stmt = $this->db->prepare("
            INSERT INTO salle (nom, ville, adresse, code_postal, telephone, email, horaires, description)
            VALUES (:nom, :ville, :adresse, :code_postal, :telephone, :email, :horaires, :description)
        ");
        $stmt->execute([
            'nom' => $nom,
            'ville' => $ville,
            'adresse' => $adresse,
            'code_postal' => $codePostal,
            'telephone' => $telephone,
            'email' => $email,
            'horaires' => $horaires,
            'description' => $description,
        ]);

        return $this->db->lastInsertId();
    }

    public function update(
        int $id,
        string $nom,
        string $ville,
        string $adresse,
        string $codePostal,
        string $telephone,
        string $email,
        string $horaires,
        string $description
    ): void {
        $stmt = $this->db->prepare("
            UPDATE salle
            SET nom = :nom,
                ville = :ville,
                adresse = :adresse,
                code_postal = :code_postal,
                telephone = :telephone,
                email = :email,
                horaires = :horaires,
                description = :description
            WHERE id = :id
        ");
        $stmt->execute([
            'id' => $id,
            'nom' => $nom,
            'ville' => $ville,
            'adresse' => $adresse,
            'code_postal' => $codePostal,
            'telephone' => $telephone,
            'email' => $email,
            'horaires' => $horaires,
            'description' => $description,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM salle WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
