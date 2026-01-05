<?php
$metaTitle = $metaTitle ?? ($title ?? 'Admin Panel');
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Security::e($metaTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/admin.css">
</head>
<body class="bg-light">
<div class="d-flex">
    <aside class="admin-sidebar bg-white border-end">
        <div class="p-3 border-bottom fw-bold">Emek Mermer Admin</div>
        <nav class="nav flex-column p-2">
            <a class="nav-link" href="/admin/dashboard">Dashboard</a>
            <a class="nav-link" href="#">Genel Ayarlar</a>
            <a class="nav-link" href="#">Slider</a>
            <a class="nav-link" href="#">Kategoriler</a>
            <a class="nav-link" href="#">Ürünler</a>
            <a class="nav-link" href="#">Blog</a>
            <a class="nav-link" href="#">SSS</a>
            <a class="nav-link" href="#">İletişim Mesajları</a>
            <a class="nav-link" href="#">301 Yönlendirmeler</a>
            <a class="nav-link" href="#">SEO Araçları</a>
            <a class="nav-link" href="#">Kullanıcılar</a>
        </nav>
    </aside>
    <main class="flex-grow-1">
        <header class="bg-white border-bottom p-3">
            <div class="d-flex justify-content-between">
                <div class="fw-semibold"><?= Security::e($title ?? '') ?></div>
                <div><?= Security::e($user['name'] ?? 'Admin') ?></div>
            </div>
        </header>
        <div class="p-4">
            <?= $content ?? '' ?>
        </div>
    </main>
</div>
</body>
</html>
