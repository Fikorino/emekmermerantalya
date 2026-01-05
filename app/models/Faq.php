<?php
class Faq extends Model
{
    public function byPage(string $pageKey): array
    {
        $stmt = $this->db->prepare('SELECT * FROM faqs WHERE page_key = :page_key AND is_active = 1 ORDER BY sort_order ASC');
        $stmt->execute(['page_key' => $pageKey]);
        return $stmt->fetchAll();
    }
}
