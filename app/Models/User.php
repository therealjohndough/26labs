<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class User {
    public static function create(string $email, string $password, string $name): bool {
        $db = Database::getConnection();
        $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);

        $stmt = $db->prepare(
            'INSERT INTO users (email, password, name, created_at) VALUES (?, ?, ?, NOW())'
        );

        return $stmt->execute([$email, $hashedPassword, $name]);
    }

    public static function find(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ? AND deleted_at IS NULL');
        $stmt->execute([$id]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public static function findByEmail(string $email): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE email = ? AND deleted_at IS NULL');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        return $user ?: null;
    }

    public static function exists(string $email): bool {
        return self::findByEmail($email) !== null;
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getConnection();
        $allowedFields = ['email', 'password', 'name'];
        $updates = [];
        $values = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $allowedFields, true)) {
                $updates[] = "$key = ?";
                $values[] = $value;
            }
        }

        if (empty($updates)) {
            return false;
        }

        $values[] = $id;
        $stmt = $db->prepare('UPDATE users SET ' . implode(', ', $updates) . ' WHERE id = ?');

        return $stmt->execute($values);
    }

    public static function updateRememberToken(int $id, string $token, int $expiry): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE users SET remember_token = ?, remember_token_expiry = FROM_UNIXTIME(?) WHERE id = ?');

        return $stmt->execute([$token, $expiry, $id]);
    }

    public static function all(): array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM users WHERE deleted_at IS NULL ORDER BY created_at DESC');
        $stmt->execute();

        return $stmt->fetchAll();
    }
}
