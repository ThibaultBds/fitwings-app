<?php 

namespace App\Models;

use App\Models\BaseModel;


Class ProgrammeModel extends BaseModel {
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM programme");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM programme WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
}