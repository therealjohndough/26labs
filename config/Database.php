<?php

namespace App\Core;

use PDO;
use PDOException;

class Database {
    private static ?PDO $connection = null;
    private static string $host;
    private static string $dbname;
    private static string $user;
    private static string $password;
    private static int $port;

    public static function initialize(string $host, string $dbname, string $user, string $password, int $port = 3306): void {
        self::$host = $host;
        self::$dbname = $dbname;
        self::$user = $user;
        self::$password = $password;
        self::$port = $port;
    }

    public static function getConnection(): PDO {
        if (self::$connection === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbname . ";charset=utf8mb4";
                self::$connection = new PDO(
                    $dsn,
                    self::$user,
                    self::$password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_EMULATE_PREPARES => false,
                        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci",
                    ]
                );
            } catch (PDOException $e) {
                die('Database connection failed: ' . htmlspecialchars($e->getMessage()));
            }
        }
        return self::$connection;
    }

    public static function closeConnection(): void {
        self::$connection = null;
    }
}
