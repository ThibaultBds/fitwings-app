<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $pdo = null;
    public static function getConnection(): PDO;

}