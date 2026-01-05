<?php
class RedirectRule extends Model
{
    public function find(string $fromPath): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM redirects WHERE from_path = :from_path LIMIT 1');
        $stmt->execute(['from_path' => $fromPath]);
        $data = $stmt->fetch();
        return $data ?: null;
    }
}
