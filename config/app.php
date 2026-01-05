<?php
return [
    'base_url' => '',
    'site_name' => 'Emek Mermer Antalya',
    'upload' => [
        'max_size' => 5 * 1024 * 1024,
        'allowed_mime' => ['image/jpeg', 'image/png', 'image/webp'],
        'allowed_ext' => ['jpg', 'jpeg', 'png', 'webp'],
        'max_width' => 1920,
        'webp' => true,
    ],
    'security' => [
        'login_rate_limit' => [
            'max_attempts' => 5,
            'window_minutes' => 10,
        ],
    ],
];
