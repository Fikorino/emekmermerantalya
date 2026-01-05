<?php
class Category extends Model
{
    public function active(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE is_active = 1 ORDER BY sort_order ASC');
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE slug = :slug LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $data = $stmt->fetch();
        return $data ?: null;
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM categories WHERE id = :id LIMIT 1');
        $stmt->execute(['id' => $id]);
        $data = $stmt->fetch();
        return $data ?: null;
    }
}
