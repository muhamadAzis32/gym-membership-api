<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


## Instalasi
#### Via Git
```bash
git clone https://github.com/muhamadAzis32/gym-membership-api.git
```

### Setup Aplikasi
Jalankan perintah 
```bash
composer update
```
atau:
```bash
composer install
```

Copy file .env dari .env.example
```bash
cp .env.example .env
```
Konfigurasi file .env
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gym_membership
DB_USERNAME=root
DB_PASSWORD=
```

Generate key
```bash
php artisan key:generate
```

Storage
```bash
php artisan storage:link
```

Migrate database
```bash
php artisan migrate
```
Menjalankan aplikasi
```bash
php artisan serve
```
