<?php
class Post extends Model
{
    public function published(int $limit = 10): array
    {
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE is_published = 1 ORDER BY published_at DESC LIMIT :limit');
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function findBySlug(string $slug): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE slug = :slug AND is_published = 1 LIMIT 1');
        $stmt->execute(['slug' => $slug]);
        $data = $stmt->fetch();
        return $data ?: null;
    }

    public function allPublished(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM posts WHERE is_published = 1 ORDER BY published_at DESC');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
