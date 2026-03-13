<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository extends BaseRepository
{
    public function findById(int $id): ?UserModel
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id LIMIT 1");
        $stmt->execute(['id' => $id]);

        return $this->toObject($stmt->fetch() ?: null, UserModel::class);
    }

    public function findByEmail(string $email): ?UserModel
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute(['email' => $email]);

        return $this->toObject($stmt->fetch() ?: null, UserModel::class);
    }

    public function create(string $username, string $email, string $password): string
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, email, password, role)
            VALUES (:username, :email, :password, 'user')
        ");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password,
        ]);

        return $this->db->lastInsertId();
    }

    public function createByAdmin(string $username, string $email, string $password, string $role = 'user'): string
    {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, email, password, role)
            VALUES (:username, :email, :password, :role)
        ");
        $stmt->execute([
            'username' => $username,
            'email' => $email,
            'password' => $password,
            'role' => $role,
        ]);

        return $this->db->lastInsertId();
    }

    public function findAll(): array
    {
        $stmt = $this->db->prepare("SELECT id, username, email, role, created_at FROM users ORDER BY id ASC");
        $stmt->execute();

        return $this->toObjects($stmt->fetchAll(), UserModel::class);
    }

    public function updateRole(int $id, string $role): void
    {
        $stmt = $this->db->prepare("UPDATE users SET role = :role WHERE id = :id");
        $stmt->execute([
            'role' => $role,
            'id' => $id,
        ]);
    }

    public function delete(int $id): void
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
