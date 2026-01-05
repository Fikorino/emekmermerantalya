<?php
ob_start();
?>
<section class="container py-5">
    <h1 class="section-title">Hakkımızda</h1>
    <p>Emek Mermer Antalya, doğal taş ve kuvars tezgah uygulamalarında 20+ yıllık deneyimiyle Antalya genelinde kurumsal hizmet sunar. Proje yönetimi, kalite kontrol ve müşteri memnuniyeti odağında çalışan ekibimizle, mermer ve granit uygulamalarında yüksek standartlar hedefliyoruz.</p>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
