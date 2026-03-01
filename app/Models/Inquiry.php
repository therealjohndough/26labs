<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Inquiry {
    public static function create(array $data): bool {
        $db = Database::getConnection();

        $stmt = $db->prepare(
            'INSERT INTO inquiries (name, company, email, message, services, budget, ip_address, user_agent, created_at) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())'
        );

        return $stmt->execute([
            $data['name'],
            $data['company'] ?? null,
            $data['email'],
            $data['message'],
            $data['services'] ?? null,
            $data['budget'] ?? null,
            $_SERVER['REMOTE_ADDR'] ?? null,
            $_SERVER['HTTP_USER_AGENT'] ?? null,
        ]);
    }

    public static function find(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM inquiries WHERE id = ?');
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public static function all(int $limit = 100): array {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            'SELECT * FROM inquiries ORDER BY created_at DESC LIMIT ?'
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function markAsRead(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE inquiries SET read_at = NOW() WHERE id = ? AND read_at IS NULL');

        return $stmt->execute([$id]);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare('DELETE FROM inquiries WHERE id = ?');

        return $stmt->execute([$id]);
    }

    public static function countUnread(): int {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT COUNT(*) FROM inquiries WHERE read_at IS NULL');
        $stmt->execute();

        return (int)$stmt->fetchColumn();
    }
}
