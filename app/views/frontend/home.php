<?php
$metaTitle = $title ?? 'Emek Mermer Antalya';
$metaDescription = 'Antalya mermer, antalya granit, çimstone antalya ve kuvars tezgah antalya çözümleri için keşif, üretim ve montaj hizmeti.';
ob_start();
?>
<section class="container py-5">
    <div class="row g-4">
        <?php foreach ($sliders as $slide): ?>
            <div class="col-12">
                <div class="hero-slide d-flex align-items-center text-white p-4" style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)), url('<?= Security::e($slide['image_path']) ?>')">
                    <div>
                        <h1 class="display-5 fw-bold"><?= Security::e($slide['title']) ?></h1>
                        <p class="lead"><?= Security::e($slide['subtitle']) ?></p>
                        <a class="btn btn-warning" href="<?= Security::e($slide['button_url']) ?>"><?= Security::e($slide['button_text']) ?></a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="container pb-5">
    <div class="row text-center">
        <div class="col-md-4">
            <h5>Keşif & Ölçülendirme</h5>
            <p>Antalya mutfak tezgahı ve banyo tezgahı için ücretsiz keşif ve ölçü alımı.</p>
        </div>
        <div class="col-md-4">
            <h5>Üretim & Uygulama</h5>
            <p>Mermer, granit ve kuvars tezgahlar CNC hassasiyetinde üretilir.</p>
        </div>
        <div class="col-md-4">
            <h5>Montaj & Garanti</h5>
            <p>Hızlı montaj, temiz işçilik ve uzun ömürlü dayanım.</p>
        </div>
    </div>
</section>

<section class="container pb-5">
    <h2 class="section-title">Ürün Kategorileri</h2>
    <div class="row g-4">
        <?php foreach ($categories as $category): ?>
            <div class="col-md-4">
                <div class="card card-hover h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= Security::e($category['name']) ?></h5>
                        <p class="card-text"><?= Security::e($category['description']) ?></p>
                        <a href="/urun-kategori/<?= Security::e($category['slug']) ?>" class="btn btn-outline-dark">Detaylı İncele</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="container pb-5">
    <h2 class="section-title">Öne Çıkan Ürünler</h2>
    <div class="row g-4">
        <?php foreach ($products as $product): ?>
            <div class="col-md-4">
                <div class="card h-100">
                    <img src="<?= Security::e($product['cover_image_path'] ?? '/assets/placeholder.svg') ?>" class="card-img-top" alt="<?= Security::e($product['name']) ?>" loading="lazy">
                    <div class="card-body">
                        <h5 class="card-title"><?= Security::e($product['name']) ?></h5>
                        <p class="card-text"><?= Security::e($product['short_desc']) ?></p>
                        <a href="/urun/<?= Security::e($product['slug']) ?>" class="btn btn-primary">Ürün Detayı</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<section class="container pb-5">
    <h2 class="section-title">Antalya Mermer ve Granit Çözümleri</h2>
    <p>Antalya mermer, antalya granit, çimstone antalya ve kuvars tezgah antalya aramalarında öne çıkan Emek Mermer Antalya, mutfak tezgahı, banyo tezgahı ve dış cephe uygulamalarında kurumsal çözümler sunar. Her projede keşif ve ölçülendirme ile başlayan süreç, üretim ve montaj aşamasında modern makinelerle desteklenir. Antalya mutfak tezgahı için granit tezgah ve kuvars tezgah seçeneklerini proje ihtiyaçlarına göre planlıyor, dayanım ve estetik için doğru malzemeyi öneriyoruz. Mermer antalya pazarında öne çıkan renk ve damar seçeneklerini yerinde gösteriyor, çimstone antalya ve kuvars tezgah antalya taleplerinde ise bakım kolaylığı ve uzun ömür avantajını öne çıkarıyoruz. Proje yönetimi, teslim süresi ve garanti süreçlerinde şeffaf iletişim sağlıyor; her aşamada müşteri memnuniyetini merkeze alıyoruz. Antalya granit ve mermer uygulamalarında öncü uzmanlık için Emek Mermer Antalya ile iletişime geçin.</p>
</section>

<section class="container pb-5">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h3>Keşif / Teklif Al</h3>
            <p>Ücretsiz keşif ve fiyat teklifi için bizimle iletişime geçin.</p>
        </div>
        <div class="col-md-4 text-md-end">
            <a href="/iletisim" class="btn btn-warning btn-lg">Teklif Al</a>
        </div>
    </div>
</section>

<section class="container pb-5">
    <h2 class="section-title">Sıkça Sorulan Sorular</h2>
    <div class="accordion" id="faqAccordion">
        <?php foreach ($faqs as $index => $faq): ?>
            <div class="accordion-item">
                <h2 class="accordion-header" id="faqHeading<?= $index ?>">
                    <button class="accordion-button <?= $index ? 'collapsed' : '' ?>" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse<?= $index ?>">
                        <?= Security::e($faq['question']) ?>
                    </button>
                </h2>
                <div id="faqCollapse<?= $index ?>" class="accordion-collapse collapse <?= $index === 0 ? 'show' : '' ?>" data-bs-parent="#faqAccordion">
                    <div class="accordion-body"><?= Security::e($faq['answer']) ?></div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "Emek Mermer Antalya",
  "address": "<?= Security::e($settings['address'] ?? 'Muratpaşa / Antalya') ?>",
  "telephone": "<?= Security::e($settings['phone'] ?? '+90 242 000 00 00') ?>",
  "areaServed": "Antalya"
}
</script>
<?php if ($faqs): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    <?php foreach ($faqs as $index => $faq): ?>
    {
      "@type": "Question",
      "name": "<?= Security::e($faq['question']) ?>",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "<?= Security::e($faq['answer']) ?>"
      }
    }<?= $index < count($faqs) - 1 ? ',' : '' ?>
    <?php endforeach; ?>
  ]
}
</script>
<?php endif; ?>
<?php
$content = ob_get_clean();
require __DIR__ . '/../layouts/frontend.php';
?>
