<?php

namespace App\Models;

use App\Core\Database;

class Service {
    public static function create(array $data): bool {
        $db = Database::getConnection();

        $stmt = $db->prepare(
            'INSERT INTO services (title, description, bullets, order_index, created_at) 
             VALUES (?, ?, ?, ?, NOW())'
        );

        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['bullets'] ?? null,
            $data['order_index'] ?? 0,
        ]);
    }

    public static function find(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM services WHERE id = ? AND deleted_at IS NULL');
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public static function all(): array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM services WHERE deleted_at IS NULL ORDER BY order_index ASC, created_at DESC');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getConnection();
        $allowedFields = ['title', 'description', 'bullets', 'order_index'];
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
        $stmt = $db->prepare('UPDATE services SET ' . implode(', ', $updates) . ', updated_at = NOW() WHERE id = ?');

        return $stmt->execute($values);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE services SET deleted_at = NOW() WHERE id = ?');

        return $stmt->execute([$id]);
    }
}
