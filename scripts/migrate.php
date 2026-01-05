<?php
require __DIR__ . '/../app/core/Database.php';

$db = Database::connection();

$queries = [
    "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(191) NOT NULL,
        email VARCHAR(191) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        role VARCHAR(50) NOT NULL DEFAULT 'admin',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login TIMESTAMP NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS settings (
        `key` VARCHAR(191) PRIMARY KEY,
        `value` TEXT NOT NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS sliders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(191) NOT NULL,
        subtitle VARCHAR(255) NOT NULL,
        button_text VARCHAR(100),
        button_url VARCHAR(255),
        image_path VARCHAR(255),
        sort_order INT DEFAULT 0,
        is_active TINYINT(1) DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS categories (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(191) NOT NULL,
        slug VARCHAR(191) NOT NULL UNIQUE,
        description TEXT,
        seo_title VARCHAR(191),
        seo_description VARCHAR(255),
        sort_order INT DEFAULT 0,
        is_active TINYINT(1) DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        category_id INT NOT NULL,
        name VARCHAR(191) NOT NULL,
        slug VARCHAR(191) NOT NULL UNIQUE,
        short_desc VARCHAR(255),
        long_desc TEXT,
        specs_json JSON,
        cover_image_path VARCHAR(255),
        seo_title VARCHAR(191),
        seo_description VARCHAR(255),
        is_active TINYINT(1) DEFAULT 1,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS product_images (
        id INT AUTO_INCREMENT PRIMARY KEY,
        product_id INT NOT NULL,
        image_path VARCHAR(255) NOT NULL,
        sort_order INT DEFAULT 0,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS posts (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(191) NOT NULL,
        slug VARCHAR(191) NOT NULL UNIQUE,
        focus_keyword VARCHAR(191),
        content_html LONGTEXT,
        seo_title VARCHAR(191),
        seo_description VARCHAR(255),
        cover_image_path VARCHAR(255),
        is_published TINYINT(1) DEFAULT 0,
        published_at TIMESTAMP NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS faqs (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_key VARCHAR(100) NOT NULL,
        question VARCHAR(255) NOT NULL,
        answer TEXT NOT NULL,
        sort_order INT DEFAULT 0,
        is_active TINYINT(1) DEFAULT 1
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS leads (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(191) NOT NULL,
        phone VARCHAR(50) NOT NULL,
        email VARCHAR(191),
        message TEXT,
        source_page VARCHAR(191),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
    "CREATE TABLE IF NOT EXISTS redirects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        from_path VARCHAR(255) NOT NULL UNIQUE,
        to_path VARCHAR(255) NOT NULL,
        code INT DEFAULT 301
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;",
];

foreach ($queries as $sql) {
    $db->exec($sql);
}

echo "Migration tamamlandı.\n";
