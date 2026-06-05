<?php

namespace App\Database;

use PDO;
use PDOException;

class Database
{
    private static ?PDO $connection = null;

    /**
     * Create and return PDO connection.
     *
     * Singleton pattern:
     * Only one database connection exists during request lifecycle.
     */
    public static function connect(): PDO
    {
        if (self::$connection === null) {

            $host = $_ENV['DB_HOST'];
            $port = $_ENV['DB_PORT'];
            $database = $_ENV['DB_NAME'];
            $username = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];

            $dsn = "mysql:host={$host};port={$port};dbname={$database};charset=utf8mb4";

            self::$connection = new PDO(
                $dsn,
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$connection;
    }
}