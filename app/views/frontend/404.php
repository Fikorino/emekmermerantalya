<?php
ob_start();
?>
<section class="container py-5 text-center">
    <h1>404</h1>
    <p>Aradığınız sayfa bulunamadı.</p>
    <a href="/" class="btn btn-primary">Ana Sayfaya Dön</a>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
