<?php

namespace App\Repositories;

use App\Models\TemoignageModel;

class TemoignageRepository extends BaseRepository
{
    public function create(int $userId, int $note, string $contenu): void
    {
        $stmt = $this->db->prepare("
            INSERT INTO temoignages (user_id, note, contenu)
            VALUES (:user_id, :note, :contenu)
        ");
        $stmt->execute([
            'user_id' => $userId,
            'note' => $note,
            'contenu' => $contenu,
        ]);
    }

    public function getEnAttente(): array
    {
        $stmt = $this->db->prepare("
            SELECT t.*, u.username
            FROM temoignages t
            JOIN users u ON t.user_id = u.id
            WHERE t.statut = 'en_attente'
        ");
        $stmt->execute();

        return $this->toObjects($stmt->fetchAll(), TemoignageModel::class);
    }

    public function updateStatut(int $id, string $statut): void
    {
        $stmt = $this->db->prepare("UPDATE temoignages SET statut = :statut WHERE id = :id");
        $stmt->execute([
            'statut' => $statut,
            'id' => $id,
        ]);
    }

    public function getApprouves(): array
    {
        $stmt = $this->db->prepare("
            SELECT t.*, u.username
            FROM temoignages t
            JOIN users u ON t.user_id = u.id
            WHERE t.statut = 'approuve'
            ORDER BY t.created_at DESC
        ");
        $stmt->execute();

        return $this->toObjects($stmt->fetchAll(), TemoignageModel::class);
    }
}
