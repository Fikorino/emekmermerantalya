<?php
class Lead extends Model
{
    public function create(array $data): void
    {
        $stmt = $this->db->prepare('INSERT INTO leads (name, phone, email, message, source_page, created_at) VALUES (:name, :phone, :email, :message, :source_page, NOW())');
        $stmt->execute($data);
    }
}
