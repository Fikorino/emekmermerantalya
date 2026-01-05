<?php
class ProductController extends Controller
{
    public function index(): void
    {
        $settings = (new Setting())->all();
        $categories = (new Category())->active();
        $products = (new Product())->featured(12);
        $this->view('frontend/products', [
            'title' => 'Ürünler | Antalya Mermer ve Granit',
            'settings' => $settings,
            'categories' => $categories,
            'products' => $products,
        ]);
    }

    public function category(string $slug): void
    {
        $category = (new Category())->findBySlug($slug);
        if (!$category) {
            http_response_code(404);
            $this->view('frontend/404', ['title' => 'Kategori bulunamadı']);
            return;
        }
        $settings = (new Setting())->all();
        $products = (new Product())->byCategory((int) $category['id']);
        $this->view('frontend/category', [
            'title' => $category['seo_title'] ?: $category['name'],
            'settings' => $settings,
            'category' => $category,
            'products' => $products,
        ]);
    }

    public function detail(string $slug): void
    {
        $product = (new Product())->findBySlug($slug);
        if (!$product) {
            http_response_code(404);
            $this->view('frontend/404', ['title' => 'Ürün bulunamadı']);
            return;
        }
        $settings = (new Setting())->all();
        $related = (new Product())->related((int) $product['category_id'], (int) $product['id']);
        $this->view('frontend/product-detail', [
            'title' => $product['seo_title'] ?: $product['name'],
            'settings' => $settings,
            'product' => $product,
            'related' => $related,
        ]);
    }
}
