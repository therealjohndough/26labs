<?php

namespace App\Models;

use App\Core\Database;
use PDO;

class CaseStudy {
    public static function create(array $data): bool {
        $db = Database::getConnection();
        $slug = self::resolveSlug($data);

        $stmt = $db->prepare(
            'INSERT INTO case_studies (title, slug, client_name, description, tags, hero_image, gallery_images, services_provided, year, created_at)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())'
        );

        return $stmt->execute([
            $data['title'],
            $slug,
            $data['client_name'],
            $data['description'],
            $data['tags'] ?? null,
            $data['hero_image'] ?? null,
            $data['gallery_images'] ?? null,
            $data['services_provided'] ?? null,
            $data['year'] ?? date('Y'),
        ]);
    }

    public static function findBySlug(string $slug): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM case_studies WHERE slug = ? AND deleted_at IS NULL');
        $stmt->execute([$slug]);

        return $stmt->fetch() ?: null;
    }

    public static function find(int $id): ?array {
        $db = Database::getConnection();
        $stmt = $db->prepare('SELECT * FROM case_studies WHERE id = ? AND deleted_at IS NULL');
        $stmt->execute([$id]);

        return $stmt->fetch() ?: null;
    }

    public static function all(int $limit = 50): array {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            'SELECT * FROM case_studies WHERE deleted_at IS NULL ORDER BY year DESC, created_at DESC LIMIT ?'
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function latest(int $limit = 6): array {
        $db = Database::getConnection();
        $stmt = $db->prepare(
            'SELECT * FROM case_studies WHERE deleted_at IS NULL ORDER BY year DESC, created_at DESC LIMIT ?'
        );
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public static function update(int $id, array $data): bool {
        $db = Database::getConnection();
        $allowedFields = ['title', 'slug', 'client_name', 'description', 'tags', 'hero_image', 'gallery_images', 'services_provided', 'year'];
        $updates = [];
        $values = [];

        foreach ($data as $key => $value) {
            if (in_array($key, $allowedFields, true)) {
                if ($key === 'slug') {
                    $value = self::resolveSlug([
                        'slug' => (string) $value,
                        'title' => (string) ($data['title'] ?? ''),
                    ]);
                }

                $updates[] = "$key = ?";
                $values[] = $value;
            }
        }

        if (empty($updates)) {
            return false;
        }

        $values[] = $id;
        $stmt = $db->prepare('UPDATE case_studies SET ' . implode(', ', $updates) . ', updated_at = NOW() WHERE id = ?');

        return $stmt->execute($values);
    }

    public static function delete(int $id): bool {
        $db = Database::getConnection();
        $stmt = $db->prepare('UPDATE case_studies SET deleted_at = NOW() WHERE id = ?');

        return $stmt->execute([$id]);
    }

    private static function resolveSlug(array $data): string {
        $slug = self::slugify((string) ($data['slug'] ?? ''));

        if ($slug !== '') {
            return $slug;
        }

        return self::slugify((string) ($data['title'] ?? ''));
    }

    private static function slugify(string $value): string {
        $value = strtolower(trim($value));
        $value = preg_replace('/[^a-z0-9]+/', '-', $value) ?? '';

        return trim($value, '-');
    }
}
