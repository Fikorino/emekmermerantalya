<?php
class View
{
    public static function render(string $template, array $data = []): void
    {
        $templatePath = __DIR__ . '/../views/' . $template . '.php';
        if (!file_exists($templatePath)) {
            throw new RuntimeException('View not found: ' . $templatePath);
        }
        extract($data, EXTR_SKIP);
        require $templatePath;
    }
}
