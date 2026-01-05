<?php
class PageController extends Controller
{
    public function services(): void
    {
        $settings = (new Setting())->all();
        $this->view('frontend/services', [
            'title' => 'Hizmetler | Antalya Mutfak Tezgahı',
            'settings' => $settings,
        ]);
    }

    public function about(): void
    {
        $settings = (new Setting())->all();
        $this->view('frontend/about', [
            'title' => 'Hakkımızda | Emek Mermer Antalya',
            'settings' => $settings,
        ]);
    }

    public function contact(): void
    {
        $settings = (new Setting())->all();
        $this->view('frontend/contact', [
            'title' => 'İletişim | Emek Mermer Antalya',
            'settings' => $settings,
            'csrf' => Security::csrfToken(),
        ]);
    }

    public function submitContact(): void
    {
        if (!Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            $settings = (new Setting())->all();
            $this->view('frontend/contact', [
                'title' => 'İletişim | Emek Mermer Antalya',
                'settings' => $settings,
                'error' => 'Güvenlik doğrulaması başarısız.',
                'csrf' => Security::csrfToken(),
            ]);
            return;
        }
        $data = [
            'name' => trim($_POST['name'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'message' => trim($_POST['message'] ?? ''),
            'source_page' => '/iletisim',
        ];
        (new Lead())->create($data);
        $settings = (new Setting())->all();
        $this->view('frontend/contact', [
            'title' => 'İletişim | Emek Mermer Antalya',
            'settings' => $settings,
            'success' => 'Mesajınız alındı, en kısa sürede dönüş yapacağız.',
            'csrf' => Security::csrfToken(),
        ]);
    }
}
