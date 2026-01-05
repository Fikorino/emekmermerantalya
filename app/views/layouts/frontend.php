<?php
$settings = $settings ?? [];
$metaTitle = $metaTitle ?? ($title ?? 'Emek Mermer Antalya');
$metaDescription = $metaDescription ?? 'Antalya mermer, granit, kuvars ve çimstone tezgah çözümleri. Keşif, üretim ve montaj süreçlerinde kurumsal hizmet.';
$canonical = $canonical ?? ($_SERVER['REQUEST_SCHEME'] ?? 'https') . '://' . ($_SERVER['HTTP_HOST'] ?? 'emekmermerantalya.com') . ($_SERVER['REQUEST_URI'] ?? '/');
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Security::e($metaTitle) ?></title>
    <meta name="description" content="<?= Security::e($metaDescription) ?>">
    <link rel="canonical" href="<?= Security::e($canonical) ?>">
    <meta property="og:title" content="<?= Security::e($metaTitle) ?>">
    <meta property="og:description" content="<?= Security::e($metaDescription) ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= Security::e($canonical) ?>">
    <meta name="twitter:card" content="summary_large_image">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/styles.css">
</head>
<body>
<header class="bg-dark text-white py-2">
    <div class="container d-flex justify-content-between flex-wrap">
        <div>☎ <?= Security::e($settings['phone'] ?? '+90 242 000 00 00') ?></div>
        <div>WhatsApp: <?= Security::e($settings['whatsapp'] ?? '+90 532 000 00 00') ?></div>
        <div><?= Security::e($settings['hours'] ?? 'Hafta içi 09:00 - 19:00') ?></div>
    </div>
</header>
<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">Emek Mermer Antalya</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/">Ana Sayfa</a></li>
                <li class="nav-item"><a class="nav-link" href="/urunler">Ürünler</a></li>
                <li class="nav-item"><a class="nav-link" href="/hizmetler">Hizmetler</a></li>
                <li class="nav-item"><a class="nav-link" href="/blog">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="/hakkimizda">Hakkımızda</a></li>
                <li class="nav-item"><a class="nav-link" href="/iletisim">İletişim</a></li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <?= $content ?? '' ?>
</main>

<footer class="bg-dark text-white mt-5">
    <div class="container py-4">
        <div class="row">
            <div class="col-md-6">
                <h5>Emek Mermer Antalya</h5>
                <p>Antalya mermer, granit, kuvars ve çimstone tezgah çözümleri. Keşif, üretim ve montaj için bizi arayın.</p>
            </div>
            <div class="col-md-6">
                <h5>İletişim</h5>
                <p><?= Security::e($settings['address'] ?? 'Muratpaşa / Antalya') ?></p>
                <p><?= Security::e($settings['phone'] ?? '+90 242 000 00 00') ?></p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
