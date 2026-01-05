<?php
ob_start();
?>
<section class="container py-5">
    <h1 class="section-title">Hizmetler</h1>
    <p>Mutfak tezgahı antalya, granit tezgah antalya ve banyo tezgahı antalya ihtiyaçlarınız için keşif, üretim ve montaj süreçlerinde tek noktadan hizmet veriyoruz.</p>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Mutfak Tezgahı</h5>
                    <p>Granit, kuvars ve çimstone seçenekleriyle modern mutfaklar.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Banyo Tezgahı</h5>
                    <p>Nem ve ısıya dayanıklı doğal taş çözümleri.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Özel Projeler</h5>
                    <p>Merdiven, dış cephe ve resepsiyon tezgahı uygulamaları.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
