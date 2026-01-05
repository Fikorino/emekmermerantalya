<?php
$router->get('/', function () {
    (new HomeController())->index();
});

$router->get('/urunler', function () {
    (new ProductController())->index();
});

$router->get('/urun-kategori/{slug}', function (array $params) {
    (new ProductController())->category($params['slug']);
});

$router->get('/urun/{slug}', function (array $params) {
    (new ProductController())->detail($params['slug']);
});

$router->get('/blog', function () {
    (new BlogController())->index();
});

$router->get('/blog/{slug}', function (array $params) {
    (new BlogController())->detail($params['slug']);
});

$router->get('/hizmetler', function () {
    (new PageController())->services();
});

$router->get('/hakkimizda', function () {
    (new PageController())->about();
});

$router->get('/iletisim', function () {
    (new PageController())->contact();
});

$router->post('/iletisim', function () {
    (new PageController())->submitContact();
});

$router->get('/admin', function () {
    (new AdminController())->login();
});

$router->post('/admin', function () {
    (new AdminController())->authenticate();
});

$router->get('/admin/dashboard', function () {
    (new AdminController())->dashboard();
});

$router->get('/sitemap.xml', function () {
    (new SeoController())->sitemap();
});
