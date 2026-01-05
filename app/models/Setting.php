<?php
class Setting extends Model
{
    public function all(): array
    {
        $stmt = $this->db->query('SELECT `key`, `value` FROM settings');
        $data = [];
        foreach ($stmt->fetchAll() as $row) {
            $data[$row['key']] = $row['value'];
        }
        return $data;
    }
}
