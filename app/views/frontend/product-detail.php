<?php
$specs = json_decode($product['specs_json'] ?? '[]', true) ?: [];
$metaTitle = $product['seo_title'] ?: $product['name'];
$metaDescription = $product['seo_description'] ?: $product['short_desc'];
ob_start();
?>
<section class="container py-5">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Ana Sayfa</a></li>
            <li class="breadcrumb-item"><a href="/urunler">Ürünler</a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= Security::e($product['name']) ?></li>
        </ol>
    </nav>
    <div class="row g-4">
        <div class="col-md-6">
            <img src="<?= Security::e($product['cover_image_path'] ?? '/assets/placeholder.svg') ?>" class="img-fluid rounded" alt="<?= Security::e($product['name']) ?>">
        </div>
        <div class="col-md-6">
            <h1><?= Security::e($product['name']) ?></h1>
            <p><?= Security::e($product['short_desc']) ?></p>
            <a class="btn btn-warning" href="https://wa.me/<?= Security::e($settings['whatsapp'] ?? '905320000000') ?>">WhatsApp Teklif Al</a>
            <hr>
            <?php if ($specs): ?>
                <h5>Teknik Özellikler</h5>
                <table class="table table-striped">
                    <tbody>
                        <?php foreach ($specs as $label => $value): ?>
                            <tr>
                                <th><?= Security::e($label) ?></th>
                                <td><?= Security::e($value) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
    <div class="mt-5">
        <h2>Detaylı Açıklama</h2>
        <p><?= Security::e($product['long_desc']) ?></p>
    </div>
</section>

<section class="container pb-5">
    <h3>İlgili Ürünler</h3>
    <div class="row g-4">
        <?php foreach ($related as $item): ?>
            <div class="col-md-3">
                <div class="card h-100">
                    <img src="<?= Security::e($item['cover_image_path'] ?? '/assets/placeholder.svg') ?>" class="card-img-top" alt="<?= Security::e($item['name']) ?>" loading="lazy">
                    <div class="card-body">
                        <h6><?= Security::e($item['name']) ?></h6>
                        <a href="/urun/<?= Security::e($item['slug']) ?>" class="btn btn-sm btn-outline-primary">Detay</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Product",
  "name": "<?= Security::e($product['name']) ?>",
  "description": "<?= Security::e($product['short_desc']) ?>",
  "image": "<?= Security::e($product['cover_image_path'] ?? '/assets/placeholder.svg') ?>"
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Ana Sayfa",
      "item": "/"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Ürünler",
      "item": "/urunler"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "<?= Security::e($product['name']) ?>",
      "item": "/urun/<?= Security::e($product['slug']) ?>"
    }
  ]
}
</script>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
