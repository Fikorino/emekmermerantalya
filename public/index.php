<?php
require __DIR__ . '/../app/core/Database.php';
require __DIR__ . '/../app/core/Model.php';
require __DIR__ . '/../app/core/View.php';
require __DIR__ . '/../app/core/Controller.php';
require __DIR__ . '/../app/core/Router.php';
require __DIR__ . '/../app/helpers/Security.php';
require __DIR__ . '/../app/helpers/Upload.php';

spl_autoload_register(function (string $class): void {\n    $paths = [\n        __DIR__ . '/../app/controllers/' . $class . '.php',\n        __DIR__ . '/../app/models/' . $class . '.php',\n    ];\n    foreach ($paths as $path) {\n        if (file_exists($path)) {\n            require $path;\n            return;\n        }\n    }\n});

session_start();

$config = require __DIR__ . '/../config/app.php';

$router = new Router();
require __DIR__ . '/../routes/web.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$redirectModel = new RedirectRule();
$rule = $redirectModel->find($uri);
if ($rule) {
    http_response_code((int) $rule['code']);
    header('Location: ' . $rule['to_path']);
    exit;
}

$router->dispatch($method, rtrim($uri, '/') ?: '/');
