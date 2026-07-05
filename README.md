# 🏢 CAKEP (CAtatan KEhadiran Pegawai)

<div align="center">
  <img src="https://img.shields.io/badge/Laravel-8.12-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 8" />
  <img src="https://img.shields.io/badge/PHP-7.3%20%7C%208.0-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP Version" />
  <img src="https://img.shields.io/badge/License-MIT-blue.svg?style=for-the-badge" alt="License MIT" />
</div>

<br>

**CAKEP (CAtatan KEhadiran Pegawai)** ini dimaksudkan sebagai aplikasi presensi untuk PPNPN BMKG H.Asan Kotawaringin Timur.

---

## 📌 Jenis Repository

Repo ini memiliki prefix **"rp"** yang berarti **"repository pribadi"**.
Artinya repository ini dikhususkan untuk penggunaan pribadi pemilik repository.
Berada di GitHub publik sebagai bentuk arsip.
Jika ingin melakukan modifikasi, silakan sesuaikan dengan environment Anda.

## 🛠️ Persyaratan

- **Webserver**: Apache, Nginx
- **Database SQL**: MySQL, MariaDB
- **PHP**: `>= 7.3`
- **Ekstensi PHP**: `BCMath`, `Ctype`, `Fileinfo`, `JSON`, `Mbstring`, `OpenSSL`, `PDO`, `Tokenizer`, `XML`
- **Package Manager PHP**: `composer` 

## 🚀 Instalasi

Silakan jalankan perintah berikut secara berurutan di terminal Anda:

```bash
git clone https://github.com/FebrianYudhis/rp-cakep.git
composer install
```

Rename file `.env.example` menjadi `.env` dan sesuaikan dengan environment Anda, lalu lanjutkan perintah berikut:

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
```

## 📖 Penggunaan

- Setiap pengguna dapat mendaftarkan akunnya, akan tetapi secara default akun akan dalam status **terkunci (locked)**.
- Peran **Admin** dapat mengelola aplikasi melalui link `/kelola`, kemudian login menggunakan akun default berikut:
  - **Username** : `admin`
  - **Password** : `admin123`
- Admin dapat **membuka kunci (unlock)** pada akun yang baru didaftarkan.
- Apabila akun gagal login, maka admin dapat **mereset** akun tersebut.

## 📄 License

The MIT License (MIT).
