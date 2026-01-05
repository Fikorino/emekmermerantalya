# Emek Mermer Antalya Kurumsal Web Sitesi

Bu proje PHP 8.1+ ve MySQL üzerinde çalışan, SEO odaklı kurumsal web sitesi + admin panel altyapısıdır.

## Kurulum (cPanel)
1. cPanel üzerinden yeni bir MySQL veritabanı ve kullanıcı oluşturun.
2. `config/db.php` dosyasındaki bilgileri güncelleyin veya ortam değişkenlerini kullanın:
   - `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`
3. Proje dosyalarını domain kök dizinine yükleyin. `public/` klasörü web root olmalıdır. Eğer domain kökü proje kökü ise `.htaccess` istekleri otomatik olarak `public/` klasörüne yönlendirir.
4. Veritabanı tablolarını oluşturmak için:
   ```bash
   php scripts/migrate.php
   ```
5. Başlangıç verilerini yüklemek için:
   ```bash
   php scripts/seed.php
   ```
6. Admin giriş bilgileri:
   - E-posta: `admin@emekmermerantalya.com`
   - Şifre: `Admin123!`

## Proje Yapısı
- `app/` -> controllers, models, views
- `public/` -> assets, uploads, index.php
- `config/` -> app.php, db.php
- `routes/` -> web.php
- `storage/` -> logs, cache
- `scripts/` -> migrate.php, seed.php
- `docs/` -> SEO planı ve keyword map

## Notlar
- Upload klasörü: `public/uploads/{yil}/{ay}`
- Slug üretimi Türkçe karakter uyumludur.
- Admin panel URL: `/admin`
