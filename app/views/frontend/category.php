<?php
$metaTitle = $category['seo_title'] ?: $category['name'];
$metaDescription = $category['seo_description'] ?: $category['description'];
ob_start();
?>
<section class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="/urunler">Ürünler</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Security::e($category['name']) ?></li>
        </ol>
    </nav>
    <h1 class="section-title"><?= Security::e($category['name']) ?></h1>
    <p><?= Security::e($category['description']) ?></p>
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
