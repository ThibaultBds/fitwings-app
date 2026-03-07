<?php

namespace App\Models;

use App\Models\BaseModel;


class ProgrammeModel extends BaseModel
{
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT * FROM programme");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM programme WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create(string $title, string $description, string $niveau, string $objectif)
    {
        $stmt = $this->db->prepare("
            INSERT INTO programme (title, description, niveau, objectif)
            VALUES (:title, :description, :niveau, :objectif)
        ");
        $stmt->execute([
            'title' => $title,
            'description' => $description,
            'niveau' => $niveau,
            'objectif' => $objectif
        ]);
        return $this->db->lastInsertId();
    }

    public function update(int $id, string $title, string $description, string $niveau, string $objectif)
    {
        $stmt = $this->db->prepare("
            UPDATE programme
            SET title = :title, description = :description, niveau = :niveau, objectif = :objectif
            WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'title' => $title,
            'description' => $description,
            'niveau' => $niveau,
            'objectif' => $objectif
        ]);
    }

    public function delete(int $id) {
        $stmt = $this->db->prepare("
        DELETE 
        FROM programme 
        WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);
    }
}
