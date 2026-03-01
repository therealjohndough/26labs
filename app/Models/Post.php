<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class Post {
    public static function create(array $data): bool {
        $db = Database::getConnection();

        $stmt = $db->prepare(
            'INSERT INTO posts (title, slug, content, featured_image, publish_date, created_at) 
             VALUES (?, ?, ?, ?, ?, NOW())'
        );

        return $stmt->execute([
            $data['title'],
            $data['slug'],
            $data['content'],
            $data['featured_image'] ?? null,
            $data['publish_date'] ?? date('Y-m-d H:i:s'),
        ]);
    }

    public static function find(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM posts WHERE id = ? AND deleted_at IS NULL');
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public static function findBySlug(string $slug): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM posts WHERE slug = ? AND deleted_at IS NULL');
        $stmt->execute([$slug]);

        return $stmt->fetch() ?: null;
    }

    public static function all(int $limit = 50): array {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            'SELECT * FROM posts WHERE deleted_at IS NULL ORDER BY publish_date DESC, created_at DESC LIMIT ?'
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function latest(int $limit = 3): array {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            'SELECT * FROM posts WHERE deleted_at IS NULL AND publish_date <= NOW() ORDER BY publish_date DESC LIMIT ?'
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getConnection();
        $allowedFields = ['title', 'slug', 'content', 'featured_image', 'publish_date'];
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
        $stmt = $db->prepare('UPDATE posts SET ' . implode(', ', $updates) . ', updated_at = NOW() WHERE id = ?');

        return $stmt->execute($values);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE posts SET deleted_at = NOW() WHERE id = ?');

        return $stmt->execute([$id]);
    }
}
