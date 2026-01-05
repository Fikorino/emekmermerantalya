<?php
ob_start();
?>
<section class="container py-5">
    <h1 class="section-title">Ürünler</h1>
    <div class="row g-4 mb-4">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-4">
                <a class="btn btn-outline-dark w-100" href="/urun-kategori/<?= Security::e($category['slug']) ?>">
                    <?= Security::e($category['name']) ?>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row g-4">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="<?= Security::e($product['cover_image_path'] ?? '/assets/placeholder.svg') ?>" class="card-img-top" alt="<?= Security::e($product['name']) ?>" loading="lazy">
                    <div class="card-body">
                        <h5><?= Security::e($product['name']) ?></h5>
                        <p><?= Security::e($product['short_desc']) ?></p>
                        <a href="/urun/<?= Security::e($product['slug']) ?>" class="btn btn-primary">Detay</a>
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
