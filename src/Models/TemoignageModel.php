<?php

namespace App\Models;

class TemoignageModel extends BaseModel
{
    public function create(string $user_id, string $note, string $contenu)
    {
        $stmt = $this->db->prepare("
            INSERT INTO temoignages (user_id, note, contenu)
            VALUES (:user_id, :note, :contenu)
        ");
        $stmt->execute(['user_id' => $user_id, 'note' => $note, 'contenu' => $contenu]);
    }

    public function getEnAttente()
    {
        $stmt = $this->db->prepare("
        SELECT t.*, u.username
        FROM temoignages t
        JOIN users u ON t.user_id = u.id
        WHERE t.statut = 'en_attente'");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function updateStatut(int $id, string $statut)
    {
        $stmt = $this->db->prepare("UPDATE temoignages SET statut = :statut WHERE id = :id");
        $stmt->execute(['statut' => $statut, 'id' => $id]);
    }

    public function getApprouves()
    {
        $stmt = $this->db->prepare("
        SELECT t.*, u.username
        FROM temoignages t
        JOIN users u ON t.user_id = u.id
        WHERE t.statut = 'approuve'
        ORDER BY t.created_at DESC
    ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
