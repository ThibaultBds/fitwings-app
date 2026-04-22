<?php

namespace App\Core;

use MongoDB\Client;
use MongoDB\Database;

class MongoConnection
{
    private static ?Database $database = null;

    public static function getDatabase(): Database
    {
        if (self::$database !== null) {
            return self::$database;
        }

        $uri = getenv('MONGO_URI') ?: 'mongodb://mongo:27017';
        $dbName = getenv('MONGO_DB') ?: 'fitwings';

        $client = new Client($uri, [], [
            'typeMap' => ['root' => 'array', 'document' => 'array'],
        ]);

        self::$database = $client->selectDatabase($dbName);

        return self::$database;
    }
}
