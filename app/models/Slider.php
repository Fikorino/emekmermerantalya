<?php
class Slider extends Model
{
    public function active(): array
    {
        $stmt = $this->db->prepare('SELECT * FROM sliders WHERE is_active = 1 ORDER BY sort_order ASC');
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
