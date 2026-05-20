<?php

namespace App\Database;

use PDO;
use PDOException;

final class Connection
{
    public static function create(): PDO
    {
        $host = $_ENV['DB_HOST']
            ?? throw new PDOException('Database host cannot be empty');
        $port = $_ENV['DB_PORT'] ?? '3306';
        $database = $_ENV['DB_NAME']
            ?? throw new PDOException('Database name cannot be empty');
        $user = $_ENV['DB_USER']
            ?? throw new PDOException('Database user cannot be empty');
        $password = $_ENV['DB_PASSWORD']
            ?? throw new PDOException('Database password cannot be empty');
        $dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $host,
            $port,
            $database
        );

        return new PDO(
            $dsn,
            $user,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );
    }
}