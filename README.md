# Rumah Sakit - Hospital Management System

<!-- Badges (GitHub Actions + Codecov) -->
[![Build Status](https://github.com/yusuppsaputra/rumahsakit/actions/workflows/ci.yml/badge.svg)](https://github.com/yusuppsaputra/rumahsakit/actions)
[![Coverage](https://codecov.io/gh/yusuppsaputra/rumahsakit/branch/main/graph/badge.svg)](https://codecov.io/gh/yusuppsaputra/rumahsakit)

Sebuah sistem manajemen rumah sakit berbasis Laravel yang disertai konfigurasi Docker (nginx, php-fpm, mysql). Proyek ini tampaknya menggunakan Filament untuk antarmuka admin dan struktur aplikasi standar Laravel di folder `src/`.

## Fitur singkat
- Sistem manajemen rumah sakit (pasien, dokter, jadwal, rekam medis, dsb.)
- Panel admin menggunakan Filament
- Disiapkan dengan Docker Compose untuk pengembangan lokal

## Prasyarat
- Docker & Docker Compose
- PHP (untuk menjalankan perintah artisan secara lokal bila perlu)
- Composer & Node.js (untuk pengembangan front-end dan dependency PHP)

## Menjalankan dengan Docker (pengembangan)
1. Salin file environment contoh jika ada: `cp src/.env.example src/.env` dan atur variabel sesuai kebutuhan.
2. Jalankan container:

```powershell
docker compose up -d --build
```

3. Masuk ke container aplikasi (jika perlu menjalankan perintah artisan/composer):

```powershell
docker compose exec php bash
# atau untuk Windows PowerShell:
docker compose exec php powershell
```

4. Jalankan migrasi dan seeder:

```powershell
php artisan migrate --seed
```

5. Akses aplikasi di `http://localhost` (atau sesuai konfigurasi `nginx/default.conf`).

## Pengembangan lokal (tanpa Docker)
Jika ingin menjalankan langsung di mesin lokal, pastikan instalasi PHP, Composer, MySQL/ MariaDB, Node.js, lalu jalankan:

```powershell
cd src
composer install
npm install
npm run dev
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

## Struktur proyek (ringkasan)
- `src/` : sumber aplikasi Laravel
- `nginx/`, `php/`, `db/` : konfigurasi layanan untuk Docker
- `docker-compose.yml` : orkestrasi layanan (root) dan/atau di `rumahsakit-2025/`

## Menjalankan tes

Di dalam folder `src/` jalankan:

```powershell
cd src
./vendor/bin/pest
```

atau

```powershell
php artisan test
```

## Kontribusi
- Buat branch fitur/fix dari `main`.
- Buka pull request dengan deskripsi perubahan dan langkah untuk mereproduksi.

## Catatan
- Pastikan file `.env` berada di tempatnya sebelum menjalankan migrasi.
- Jika terdapat lebih dari satu `docker-compose.yml` di subfolder (mis. `rumahsakit-2025/`), periksa mana yang ingin Anda gunakan untuk lingkungan tertentu.

## Lisensi
Lisensi belum ditentukan — tambahkan `LICENSE` jika diperlukan.

---

Jika Anda ingin saya tambahkan bagian yang lebih spesifik (mis. detail endpoint, instruksi deploy, atau badge CI), beri tahu saya dan saya akan perbarui `README.md`.
