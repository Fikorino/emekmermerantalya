<?php
ob_start();
?>
<section class="container py-5">
    <h1 class="section-title">Blog</h1>
    <div class="row g-4">
        <?php foreach ($posts as $post): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="<?= Security::e($post['cover_image_path'] ?? '/assets/placeholder.svg') ?>" class="card-img-top" alt="<?= Security::e($post['title']) ?>" loading="lazy">
                    <div class="card-body">
                        <h5><?= Security::e($post['title']) ?></h5>
                        <p><?= Security::e($post['seo_description']) ?></p>
                        <a href="/blog/<?= Security::e($post['slug']) ?>" class="btn btn-outline-primary">Devamı</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
