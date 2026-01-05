<?php
class AdminController extends Controller
{
    public function login(): void
    {
        $this->view('admin/login', [
            'title' => 'Admin Giriş',
            'csrf' => Security::csrfToken(),
        ]);
    }

    public function authenticate(): void
    {
        if (!Security::validateCsrf($_POST['csrf_token'] ?? null)) {
            http_response_code(419);
            $this->view('admin/login', [
                'title' => 'Admin Giriş',
                'error' => 'Güvenlik doğrulaması başarısız.',
                'csrf' => Security::csrfToken(),
            ]);
            return;
        }

        if ($this->isRateLimited()) {
            http_response_code(429);
            $this->view('admin/login', [
                'title' => 'Admin Giriş',
                'error' => 'Çok fazla deneme yapıldı. Lütfen daha sonra tekrar deneyin.',
                'csrf' => Security::csrfToken(),
            ]);
            return;
        }

        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $user = (new User())->findByEmail($email);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            $this->registerFailedAttempt();
            $this->view('admin/login', [
                'title' => 'Admin Giriş',
                'error' => 'E-posta veya şifre hatalı.',
                'csrf' => Security::csrfToken(),
            ]);
            return;
        }

        $_SESSION['admin_user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'role' => $user['role'],
        ];
        (new User())->updateLastLogin((int) $user['id']);
        $this->resetRateLimit();
        $this->redirect('/admin/dashboard');
    }

    public function dashboard(): void
    {
        if (empty($_SESSION['admin_user'])) {
            $this->redirect('/admin');
        }
        $this->view('admin/dashboard', [
            'title' => 'Yönetim Paneli',
            'user' => $_SESSION['admin_user'],
        ]);
    }

    private function isRateLimited(): bool
    {
        $config = require __DIR__ . '/../../config/app.php';
        $limit = $config['security']['login_rate_limit'];
        $window = $limit['window_minutes'] * 60;
        $attempts = $_SESSION['login_attempts'] ?? [];
        $attempts = array_filter($attempts, fn ($time) => $time > (time() - $window));
        $_SESSION['login_attempts'] = $attempts;
        return count($attempts) >= $limit['max_attempts'];
    }

    private function registerFailedAttempt(): void
    {
        $_SESSION['login_attempts'][] = time();
    }

    private function resetRateLimit(): void
    {
        $_SESSION['login_attempts'] = [];
    }
}
