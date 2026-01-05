<?php
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/helpers/Security.php';

$db = Database::connection();

function tableEmpty(PDO $db, string $table): bool
{
    $stmt = $db->query("SELECT COUNT(*) AS count FROM {$table}");
    return (int) $stmt->fetch()['count'] === 0;
}

if (tableEmpty($db, 'users')) {
    $stmt = $db->prepare('INSERT INTO users (name, email, password_hash, role) VALUES (:name, :email, :password_hash, :role)');
    $stmt->execute([
        'name' => 'Admin',
        'email' => 'admin@emekmermerantalya.com',
        'password_hash' => password_hash('Admin123!', PASSWORD_DEFAULT),
        'role' => 'admin',
    ]);
}

if (tableEmpty($db, 'settings')) {
    $settings = [
        'phone' => '+90 242 000 00 00',
        'whatsapp' => '905320000000',
        'address' => 'Muratpaşa / Antalya',
        'hours' => 'Hafta içi 09:00 - 19:00',
        'map_embed' => '<iframe src="https://maps.google.com" width="100%" height="250" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
    ];
    $stmt = $db->prepare('INSERT INTO settings (`key`, `value`) VALUES (:key, :value)');
    foreach ($settings as $key => $value) {
        $stmt->execute(['key' => $key, 'value' => $value]);
    }
}

if (tableEmpty($db, 'sliders')) {
    $stmt = $db->prepare('INSERT INTO sliders (title, subtitle, button_text, button_url, image_path, sort_order, is_active) VALUES (:title, :subtitle, :button_text, :button_url, :image_path, :sort_order, :is_active)');
    $slides = [
        ['Antalya Mermer & Granit Uzmanı', 'Mutfak ve banyo tezgahlarında kurumsal çözümler', 'Teklif Al', '/iletisim', '/assets/placeholder.svg', 1, 1],
        ['Çimstone & Kuvars Tezgah', 'Modern mutfaklar için dayanıklı yüzeyler', 'Ürünleri İncele', '/urunler', '/assets/placeholder.svg', 2, 1],
        ['Ücretsiz Keşif & Ölçü', 'Antalya genelinde hızlı keşif hizmeti', 'Hemen Ara', '/iletisim', '/assets/placeholder.svg', 3, 1],
    ];
    foreach ($slides as $slide) {
        $stmt->execute([
            'title' => $slide[0],
            'subtitle' => $slide[1],
            'button_text' => $slide[2],
            'button_url' => $slide[3],
            'image_path' => $slide[4],
            'sort_order' => $slide[5],
            'is_active' => $slide[6],
        ]);
    }
}

if (tableEmpty($db, 'categories')) {
    $stmt = $db->prepare('INSERT INTO categories (name, slug, description, seo_title, seo_description, sort_order, is_active) VALUES (:name, :slug, :description, :seo_title, :seo_description, :sort_order, :is_active)');
    $categories = [
        ['Mermer', 'mermer', 'Antalya mermer çeşitleri ve doğal taş uygulamaları.', 'Mermer Antalya | Doğal Taş Çözümleri', 'Antalya mermer kategorisi, mermer basamak ve tezgah çözümleri.', 1, 1],
        ['Granit', 'granit', 'Antalya granit tezgah ve dış cephe taşları.', 'Granit Antalya | Dayanıklı Tezgahlar', 'Antalya granit seçenekleri ve granit tezgah çözümleri.', 2, 1],
        ['Çimstone / Kuvars', 'cimstone-kuvars', 'Çimstone ve kuvars tezgah antalya çözümleri.', 'Çimstone Antalya | Kuvars Tezgah', 'Kuvars tezgah antalya seçenekleri, modern mutfaklar için.', 3, 1],
    ];
    foreach ($categories as $category) {
        $stmt->execute([
            'name' => $category[0],
            'slug' => $category[1],
            'description' => $category[2],
            'seo_title' => $category[3],
            'seo_description' => $category[4],
            'sort_order' => $category[5],
            'is_active' => $category[6],
        ]);
    }
}

if (tableEmpty($db, 'products')) {
    $stmt = $db->prepare('INSERT INTO products (category_id, name, slug, short_desc, long_desc, specs_json, cover_image_path, seo_title, seo_description, is_active) VALUES (:category_id, :name, :slug, :short_desc, :long_desc, :specs_json, :cover_image_path, :seo_title, :seo_description, :is_active)');
    $products = [
        [1, 'Antalya Mermer Mutfak Tezgahı', 'antalya-mermer-mutfak-tezgahi', 'Klasik damar yapısıyla mermer mutfak tezgahı.', 'Antalya mermer mutfak tezgahlarında doğal görünüm ve estetik çizgi sunar.', json_encode(['Kalınlık' => '2 cm', 'Renk' => 'Beyaz', 'Kullanım' => 'Mutfak']), '/assets/placeholder.svg', 'Antalya Mermer Mutfak Tezgahı', 'Mermer mutfak tezgahı antalya uygulamaları.', 1],
        [2, 'Granit Tezgah Siyah Galaxy', 'granit-tezgah-siyah-galaxy', 'Yüksek dayanımlı granit tezgah.', 'Antalya granit tezgah projelerinde çizilmeye ve ısıya dayanıklıdır.', json_encode(['Kalınlık' => '3 cm', 'Renk' => 'Siyah', 'Kullanım' => 'Mutfak']), '/assets/placeholder.svg', 'Granit Tezgah Antalya', 'Granit tezgah antalya için dayanıklı seçenek.', 1],
        [3, 'Çimstone Kuvars Tezgah', 'cimstone-kuvars-tezgah', 'Modern mutfaklar için kuvars tezgah.', 'Çimstone antalya kuvars tezgah uygulamalarında geniş renk seçeneği.', json_encode(['Kalınlık' => '2 cm', 'Renk' => 'Gri', 'Kullanım' => 'Mutfak']), '/assets/placeholder.svg', 'Kuvars Tezgah Antalya', 'Kuvars tezgah antalya çözümleri.', 1],
    ];
    foreach ($products as $product) {
        $stmt->execute([
            'category_id' => $product[0],
            'name' => $product[1],
            'slug' => $product[2],
            'short_desc' => $product[3],
            'long_desc' => $product[4],
            'specs_json' => $product[5],
            'cover_image_path' => $product[6],
            'seo_title' => $product[7],
            'seo_description' => $product[8],
            'is_active' => $product[9],
        ]);
    }
}

if (tableEmpty($db, 'faqs')) {
    $stmt = $db->prepare('INSERT INTO faqs (page_key, question, answer, sort_order, is_active) VALUES (:page_key, :question, :answer, :sort_order, :is_active)');
    $faqs = [
        ['home', 'Antalya mermer fiyatları nasıl belirlenir?', 'Metrekare, kalınlık ve işçilik detaylarına göre fiyatlandırma yapılır.', 1, 1],
        ['home', 'Granit tezgah mı kuvars tezgah mı daha dayanıklı?', 'Granit doğal yapısı ile ısıya dayanıklıdır, kuvars ise leke tutmama avantajı sunar.', 2, 1],
        ['home', 'Keşif ve ölçü hizmeti ücretsiz mi?', 'Antalya genelinde ücretsiz keşif ve ölçülendirme sağlıyoruz.', 3, 1],
    ];
    foreach ($faqs as $faq) {
        $stmt->execute([
            'page_key' => $faq[0],
            'question' => $faq[1],
            'answer' => $faq[2],
            'sort_order' => $faq[3],
            'is_active' => $faq[4],
        ]);
    }
}

function buildArticle(string $title, string $keyword, array $sections): array
{
    $baseParagraphs = [
        'Antalya genelinde mermer, granit ve kuvars tezgah çözümleri seçerken doğru malzeme analizi yapmak önemlidir. Doğal taşların damar yapısı, kalınlığı ve kullanım alanına uygunluğu uzun ömürlü bir sonuç sağlar.',
        'Mutfak tezgahı antalya projelerinde ölçü alma, keşif ve montaj aşamaları profesyonel ekip tarafından yapılmalıdır. Bu süreçte iletişim ve planlama, teslimat süresini kısaltır.',
        'Granit tezgah antalya uygulamalarında yüksek ısı dayanımı ve darbe direnci öne çıkar. Kuvars tezgah antalya ise leke tutmayan yapısı ve modern renk skalasıyla tercih edilir.',
        'Çimstone antalya ürünleri, mutfak ve banyo tezgahı için hijyenik bir yüzey sunar. Doğru bakım rutinleriyle yüzey parlaklığı uzun süre korunur.',
        'Antalya mermer ve granit uygulamalarında fiyatlandırma, malzeme kalitesi, taşıma ve işçilik süreçleriyle birlikte değerlendirilir. Bu nedenle doğru keşif raporu hazırlanmalıdır.',
    ];

    $contentParts = [];
    $contentParts[] = "<p><strong>{$keyword}</strong> odağında hazırlanan bu rehber, {$title} konusu için kapsamlı bilgiler sunar.</p>";

    foreach ($sections as $heading => $body) {
        $contentParts[] = "<h2>{$heading}</h2>";
        $contentParts[] = "<p>{$body}</p>";
        $contentParts[] = "<p>{$baseParagraphs[array_rand($baseParagraphs)]}</p>";
    }

    $contentParts[] = '<h2>İç Bağlantı Önerileri</h2>';
    $contentParts[] = '<ul>';
    $contentParts[] = '<li><a href="/urunler">Ürünler sayfası</a> üzerinden Antalya mermer ve granit seçeneklerini inceleyin.</li>';
    $contentParts[] = '<li><a href="/urun-kategori/mermer">Mermer kategorisi</a> ile doğal taş detaylarına ulaşın.</li>';
    $contentParts[] = '<li><a href="/urun-kategori/granit">Granit kategorisi</a> ile dayanıklılık karşılaştırması yapın.</li>';
    $contentParts[] = '</ul>';

    $contentParts[] = '<h2>Sıkça Sorulan Sorular</h2>';
    $contentParts[] = '<h3>Antalya mermer ve granit projeleri ne kadar sürer?</h3>';
    $contentParts[] = '<p>Keşif, üretim ve montaj süreçleri genellikle 7-15 gün arasında tamamlanır.</p>';
    $contentParts[] = '<h3>Kuvars tezgah antalya uygulamalarında bakım nasıl yapılır?</h3>';
    $contentParts[] = '<p>Günlük temizlik için yumuşak bir bez ve pH dengeli temizleyici yeterlidir.</p>';

    $content = implode("\n", $contentParts);
    $wordCount = str_word_count(strip_tags($content));

    while ($wordCount < 950) {
        $content .= "\n<p>{$baseParagraphs[array_rand($baseParagraphs)]}</p>";
        $wordCount = str_word_count(strip_tags($content));
    }

    return [
        'content' => $content,
        'word_count' => str_word_count(strip_tags($content)),
    ];
}

if (tableEmpty($db, 'posts')) {
    $posts = [
        [
            'title' => 'Antalya Mermer Fiyatları (2026 Rehberi)',
            'keyword' => 'antalya mermer fiyatları',
            'sections' => [
                '2026 Fiyat Trendleri' => 'Antalya mermer fiyatları 2026 döneminde döviz kuru, enerji maliyetleri ve ocak üretimine bağlı olarak değişim gösterir.',
                'Metrekare ve İşçilik Kalemleri' => 'Fiyat belirlerken metrekare, kenar işçiliği ve montaj dahil hizmet kalemleri ayrı değerlendirilir.',
                'Bütçe Planlama İpuçları' => 'Projeniz için net keşif raporu ve teklif çizelgesi almak bütçe yönetimini kolaylaştırır.',
            ],
        ],
        [
            'title' => 'Granit Tezgah mı Çimstone mu? Karşılaştırma',
            'keyword' => 'granit tezgah antalya',
            'sections' => [
                'Dayanım ve Isı Performansı' => 'Granit tezgah antalya projelerinde yüksek ısı dayanımıyla öne çıkar.',
                'Leke Tutma ve Hijyen' => 'Çimstone antalya ürünleri düşük gözeneklilikle hijyenik kullanım sunar.',
                'Estetik ve Renk Seçenekleri' => 'Kuvars ve çimstone gruplarında daha geniş renk ve doku alternatifi bulunur.',
            ],
        ],
        [
            'title' => 'Kuvars Tezgah Bakımı: Leke ve Çizik Rehberi',
            'keyword' => 'kuvars tezgah antalya',
            'sections' => [
                'Günlük Bakım Rutini' => 'Kuvars yüzeylerde pH dengeli temizlik ürünleri kullanılmalıdır.',
                'Leke Yönetimi' => 'Hızlı müdahale ve yumuşak bez ile leke oluşumu minimize edilir.',
                'Çizik Önleme' => 'Kesme tahtası kullanımı ve sıcak tencere altlığı yüzeyi korur.',
            ],
        ],
        [
            'title' => 'Mutfak Tezgahı Ölçüsü Nasıl Alınır? (Antalya)',
            'keyword' => 'mutfak tezgahı antalya',
            'sections' => [
                'Keşif Süreci' => 'Antalya mutfak tezgahı keşfinde alan ölçümü ve tesisat noktaları analiz edilir.',
                'Doğru Ölçü Alma' => 'Duvar açısı, pencere hizası ve dolap derinliği doğru ölçüm için kritiktir.',
                'Montaj Öncesi Kontrol' => 'İmalat öncesi ölçü teyidi, montajda hata payını düşürür.',
            ],
        ],
        [
            'title' => 'Mermer mi Granit mi? Kullanım Alanına Göre Seçim',
            'keyword' => 'mermer antalya',
            'sections' => [
                'Mutfak ve Banyo İçin Seçim' => 'Mermer estetik görünüm sunarken granit daha yüksek dayanım sağlar.',
                'Yoğun Kullanım Alanları' => 'Granit antalya projelerinde yoğun kullanıma uygun alternatif olarak öne çıkar.',
                'Bakım ve Temizlik' => 'Her iki malzeme için düzenli bakım önerileri kullanıcı deneyimini artırır.',
            ],
        ],
        [
            'title' => 'Çimstone Renkleri ve Trendler',
            'keyword' => 'çimstone antalya',
            'sections' => [
                'Trend Renk Paletleri' => 'Bej, gri ve beyaz tonları modern mutfaklarda öne çıkıyor.',
                'Doku ve Damar Seçimleri' => 'Minimal damar yapısı hijyenik ve sade bir görünüm sağlar.',
                'Proje Uyumlandırma' => 'Mevcut dolap ve zemin ile uyumlu renk seçimi önemlidir.',
            ],
        ],
        [
            'title' => 'Banyo Tezgahında Dayanıklı Taş Seçimi',
            'keyword' => 'banyo tezgahı antalya',
            'sections' => [
                'Neme Dayanım' => 'Banyo alanlarında düşük emiciliğe sahip taşlar tercih edilmelidir.',
                'Kaymaz Yüzeyler' => 'Güvenli kullanım için yüzey finisajı doğru seçilmelidir.',
                'Bakım Kolaylığı' => 'Düzenli temizlikle yüzey performansı korunur.',
            ],
        ],
        [
            'title' => 'Mermer Basamak/Merdiven Yaptırırken Dikkat Edilecekler',
            'keyword' => 'antalya mermer',
            'sections' => [
                'Kalınlık ve Taşıma' => 'Basamaklarda taşıma kapasitesi için uygun kalınlık seçilir.',
                'Kaydırmazlık' => 'Güvenlik için yüzey işlemi ve kenar pahları önemlidir.',
                'Montaj Süreci' => 'Doğru montaj, uzun süreli dayanım sağlar.',
            ],
        ],
        [
            'title' => 'Dış Cephe Doğal Taş Kaplama Avantajları',
            'keyword' => 'antalya granit',
            'sections' => [
                'Isı ve Ses Yalıtımı' => 'Doğal taş kaplamalar yapıya ek koruma sağlar.',
                'Estetik Değer' => 'Dış cephede doğal taş, prestijli bir görünüm oluşturur.',
                'Bakım ve Dayanıklılık' => 'Dış cephede granit uzun ömürlü bir çözümdür.',
            ],
        ],
        [
            'title' => 'Antalya’da Keşiften Montaja Tezgah Süreci',
            'keyword' => 'kuvars tezgah antalya',
            'sections' => [
                'Keşif Planlaması' => 'İhtiyaç analizi ve yerinde keşif sürecin başlangıcıdır.',
                'Üretim ve Montaj' => 'Kesim, işçilik ve montaj aşamaları uzman ekiplerle yürütülür.',
                'Teslim ve Garanti' => 'Teslim sonrası bakım ve garanti süreçleri planlanır.',
            ],
        ],
    ];

    $stmt = $db->prepare('INSERT INTO posts (title, slug, focus_keyword, content_html, seo_title, seo_description, cover_image_path, is_published, published_at) VALUES (:title, :slug, :focus_keyword, :content_html, :seo_title, :seo_description, :cover_image_path, :is_published, :published_at)');

    foreach ($posts as $post) {
        $article = buildArticle($post['title'], $post['keyword'], $post['sections']);
        $stmt->execute([
            'title' => $post['title'],
            'slug' => Security::slugify($post['title']),
            'focus_keyword' => $post['keyword'],
            'content_html' => $article['content'],
            'seo_title' => $post['title'] . ' | Emek Mermer Antalya',
            'seo_description' => $post['keyword'] . ' için güncel bilgiler ve uygulama rehberi.',
            'cover_image_path' => '/assets/placeholder.svg',
            'is_published' => 1,
            'published_at' => date('Y-m-d H:i:s'),
        ]);
    }
}

echo "Seed tamamlandı.\n";
