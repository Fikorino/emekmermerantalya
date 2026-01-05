<?php
$metaTitle = $post['seo_title'] ?: $post['title'];
$metaDescription = $post['seo_description'] ?? '';
ob_start();
?>
<section class="container py-5">
    <h1><?= Security::e($post['title']) ?></h1>
    <p class="text-muted">Odak Kelime: <?= Security::e($post['focus_keyword']) ?></p>
    <article class="prose">
        <?= $post['content_html'] ?>
    </article>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
