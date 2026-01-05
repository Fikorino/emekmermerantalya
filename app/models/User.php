<?php
class User extends Model
{
    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch();
        return $data ?: null;
    }

    public function updateLastLogin(int $id): void
    {
        $stmt = $this->db->prepare('UPDATE users SET last_login = NOW() WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
