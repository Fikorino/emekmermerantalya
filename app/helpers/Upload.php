<?php
class Upload
{
    public static function handle(array $file, array $config): ?string
    {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        if ($file['size'] > $config['max_size']) {
            return null;
        }
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);
        if (!in_array($mime, $config['allowed_mime'], true)) {
            return null;
        }
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, $config['allowed_ext'], true)) {
            return null;
        }

        $year = date('Y');
        $month = date('m');
        $uploadDir = __DIR__ . '/../../public/uploads/' . $year . '/' . $month;
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        $filename = bin2hex(random_bytes(16)) . '.' . $ext;
        $destination = $uploadDir . '/' . $filename;

        if (!move_uploaded_file($file['tmp_name'], $destination)) {
            return null;
        }

        self::resizeImage($destination, $mime, $config['max_width']);

        if ($config['webp'] && $mime !== 'image/webp') {
            self::convertToWebp($destination, $ext);
        }

        return '/uploads/' . $year . '/' . $month . '/' . $filename;
    }

    private static function resizeImage(string $path, string $mime, int $maxWidth): void
    {
        [$width, $height] = getimagesize($path);
        if ($width <= $maxWidth) {
            return;
        }
        $ratio = $height / $width;
        $newWidth = $maxWidth;
        $newHeight = (int) round($newWidth * $ratio);

        $src = self::createImageResource($path, $mime);
        if (!$src) {
            return;
        }
        $dst = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($dst, $path, 85);
                break;
            case 'image/png':
                imagepng($dst, $path, 8);
                break;
            case 'image/webp':
                imagewebp($dst, $path, 80);
                break;
        }
        imagedestroy($src);
        imagedestroy($dst);
    }

    private static function convertToWebp(string $path, string $ext): void
    {
        $mime = match ($ext) {
            'jpg', 'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            default => null,
        };
        if ($mime === null) {
            return;
        }
        $src = self::createImageResource($path, $mime);
        if (!$src) {
            return;
        }
        $webpPath = preg_replace('/\.' . preg_quote($ext, '/') . '$/', '.webp', $path);
        imagewebp($src, $webpPath, 80);
        imagedestroy($src);
    }

    private static function createImageResource(string $path, string $mime)
    {
        return match ($mime) {
            'image/jpeg' => imagecreatefromjpeg($path),
            'image/png' => imagecreatefrompng($path),
            'image/webp' => imagecreatefromwebp($path),
            default => null,
        };
    }
}
