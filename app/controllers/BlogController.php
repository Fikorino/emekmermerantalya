<?php
class BlogController extends Controller
{
    public function index(): void
    {
        $settings = (new Setting())->all();
        $posts = (new Post())->published(12);
        $this->view('frontend/blog', [
            'title' => 'Blog | Antalya Mermer ve Granit',
            'settings' => $settings,
            'posts' => $posts,
        ]);
    }

    public function detail(string $slug): void
    {
        $post = (new Post())->findBySlug($slug);
        if (!$post) {
            http_response_code(404);
            $this->view('frontend/404', ['title' => 'Blog yazısı bulunamadı']);
            return;
        }
        $settings = (new Setting())->all();
        $this->view('frontend/blog-detail', [
            'title' => $post['seo_title'] ?: $post['title'],
            'settings' => $settings,
            'post' => $post,
        ]);
    }
}
