<?php

namespace App\Service;

use App\Repositories\UserRepository;

class UserAdminService
{
    private UserRepository $userRepository;

    public function __construct(?UserRepository $userRepository = null)
    {
        $this->userRepository = $userRepository ?? new UserRepository();
    }

    public function updateRole(int $actorId, int $targetId, string $newRole): bool
    {
        if ($targetId <= 0 || $actorId === $targetId) {
            return false;
        }
        if (!in_array($newRole, ['user', 'moderateur', 'admin'], true)) {
            return false;
        }

        $this->userRepository->updateRole($targetId, $newRole);
        return true;
    }

    public function deleteUser(int $actorId, int $targetId): bool
    {
        if ($targetId <= 0 || $actorId === $targetId) {
            return false;
        }

        $this->userRepository->delete($targetId);
        return true;
    }

    public function createUser(string $username, string $email, string $password, string $role): bool
    {
        if ($username === '' || $email === '' || $password === '' || strlen($password) < 8) {
            return false;
        }
        if (!in_array($role, ['user', 'moderateur', 'admin'], true)) {
            return false;
        }
        if ($this->userRepository->findByEmail($email)) {
            return false;
        }

        $this->userRepository->createByAdmin($username, $email, password_hash($password, PASSWORD_DEFAULT), $role);
        return true;
    }
}
