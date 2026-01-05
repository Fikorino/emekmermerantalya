<?php
class HomeController extends Controller
{
    public function index(): void
    {
        $settings = (new Setting())->all();
        $sliders = (new Slider())->active();
        $categories = (new Category())->active();
        $products = (new Product())->featured();
        $faqs = (new Faq())->byPage('home');

        $this->view('frontend/home', [
            'title' => 'Antalya Mermer, Granit ve Kuvars Tezgah | Emek Mermer Antalya',
            'settings' => $settings,
            'sliders' => $sliders,
            'categories' => $categories,
            'products' => $products,
            'faqs' => $faqs,
        ]);
    }
}
