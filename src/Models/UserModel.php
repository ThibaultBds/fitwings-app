<?php

namespace App\Models;


class UserModel extends BaseModel {
    public function findByEmail(string $email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create(string $username, string $email, string $password) {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, email, password, role)
            VALUES (:username, :email, :password, 'user')
        ");

        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);

        return $this->db->lastInsertId();
    }

    public function findAll() {
    $stmt = $this->db->prepare("SELECT id, username, email, role, created_at FROM users ORDER BY id ASC");
    $stmt->execute();
    return $stmt->fetchAll();
}
}

    
