# Ticket System

Laravel 7 ile geliştirilmiştir.

## Installation
Projeyi indirip, proje dizinine geçtikten sonra;

composer paketlerini kur.

```bash
composer install
```
.env dosyası oluştur (DİKKAT: Cache Driver array olmalıdır)
```bash
cp .env.example .env
```
uygulama için key tanımlayınız
```bash
php artisan key:generate
```

Veritabanı bilgilerini tanımlayınız.

Veritabanı bilgilerini tanımladıktan sonra,
```bash
php artisan migrate
```
Seed komutuyla örnek datalar oluşturunuz.
```bash
php artisan db:seed
```

Ve uygulama kullanıma hazır!
