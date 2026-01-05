<?php
class Product extends Model
{
    public function featured(int $limit = 6): array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE is_active = 1 ORDER BY created_at DESC LIMIT :limit');
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function byCategory(int $categoryId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE category_id = :category_id AND is_active = 1 ORDER BY created_at DESC');
        $stmt->execute(['category_id' => $categoryId]);
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $data = $stmt->fetch();
        return $data ?: null;
    }

    public function related(int $categoryId, int $excludeId, int $limit = 4): array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE category_id = :category_id AND id != :exclude_id AND is_active = 1 LIMIT :limit');
        $stmt->bindValue('category_id', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue('exclude_id', $excludeId, PDO::PARAM_INT);
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function allActive(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE is_active = 1 ORDER BY created_at DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
