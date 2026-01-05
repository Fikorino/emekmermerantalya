<?php
class SeoController extends Controller
{
    public function sitemap(): void
    {
        header('Content-Type: application/xml; charset=UTF-8');
        $base = $this->baseUrl();

        $urls = [
            '/',
            '/urunler',
            '/hizmetler',
            '/hakkimizda',
            '/iletisim',
            '/blog',
        ];

        $categoryModel = new Category();
        foreach ($categoryModel->active() as $category) {
            $urls[] = '/urun-kategori/' . $category['slug'];
        }

        $productModel = new Product();
        foreach ($productModel->allActive() as $product) {
            $urls[] = '/urun/' . $product['slug'];
        }

        $postModel = new Post();
        foreach ($postModel->allPublished() as $post) {
            $urls[] = '/blog/' . $post['slug'];
        }

        echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
        echo "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">\n";
        foreach ($urls as $url) {
            $loc = rtrim($base, '/') . $url;
            echo "  <url><loc>" . htmlspecialchars($loc, ENT_XML1) . "</loc></url>\n";
        }
        echo "</urlset>";
    }

    private function baseUrl(): string
    {
        $scheme = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
        $host = $_SERVER['HTTP_HOST'] ?? 'emekmermerantalya.com';
        return $scheme . '://' . $host;
    }
}
