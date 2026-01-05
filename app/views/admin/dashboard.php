<?php
ob_start();
?>
<h2>Hoş geldiniz, <?= Security::e($user['name'] ?? 'Admin') ?></h2>
<p>Panel üzerinden slider, ürün, blog ve SEO ayarlarını yönetebilirsiniz.</p>
<div class="row g-4">
    <div class="col-md-3">
        <div class="card text-bg-light">
            <div class="card-body">
                <h6>Slider</h6>
                <p>3-6 slide önerilir.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-light">
            <div class="card-body">
                <h6>Ürünler</h6>
                <p>Teknik özellikleri JSON olarak yönetin.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-light">
            <div class="card-body">
                <h6>Blog</h6>
                <p>SEO uyumlu makaleler ekleyin.</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-bg-light">
            <div class="card-body">
                <h6>Leads</h6>
                <p>İletişim mesajlarını takip edin.</p>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/admin.php';
?>
