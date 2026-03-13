<?php

namespace App\Repositories;

use App\Core\Database;
use PDO;

abstract class BaseRepository
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    protected function toObject(?array $data, string $class): ?object
    {
        if (empty($data)) {
            return null;
        }

        return new $class($data);
    }

    protected function toObjects(array $rows, string $class): array
    {
        $result = [];
        foreach ($rows as $row) {
            $result[] = new $class($row);
        }
        return $result;
    }
}
